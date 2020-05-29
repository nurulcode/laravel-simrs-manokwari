<template>
    <div class="DataTable">
        <div class="row">
            <div style="min-width:182px;" class="mb-3 col-md-2 col-xs-12">
                <data-table-row-limitter v-model="localPerPage"></data-table-row-limitter>
            </div>
            <div class="mb-3 col">
                <div class="row">
                    <slot name="before-search"></slot>
                    <div class="col">
                        <data-table-filter @change="doSearch" v-bind:value="search">

                        </data-table-filter>
                    </div>
                </div>
            </div>
            <div class="mb-3 col d-flex col-md-auto col-lg-auto">
                <slot name="before-top-button"></slot>
                <div v-if="!noAddButtonText" class="ml-auto">
                    <button class="btn btn-primary" v-on:click.prevent="create"> {{ addButtonText }} </button>
                </div>
            </div>
        </div>
        <b-table ref="table"
            v-bind:busy.sync="is_busy"
            v-bind:current-page.sync="currentPage"
            v-bind:fields="computedFields"
            v-bind:filter="search"
            v-bind:items="provider"
            v-bind:per-page.sync="localPerPage"
            v-bind:sort-by.sync="localSortBy"
            v-bind:sort-desc.sync="localSortDesc"
            v-bind="options"
            v-click-outside="clearSelected"
            v-model="items"
            v-on:row-dblclicked="onDoubleClick"
            v-on:row-clicked="toggleSelected"
            >
            <template slot="dt-index" slot-scope="{ index }" v-if="!noIndex">
                {{ index+1 + ((currentPage-1) * localPerPage) }}
            </template>

            <template v-for="sslot in scopedSlots" :slot='sslot' slot-scope="data">
                <slot v-bind="data" :name="sslot"> {{ data.value }} </slot>
            </template>

            <template slot="dt-action" slot-scope="data">
                <button v-if="!noEdit" v-on:click="edit(data.item)" v-bind:disabled="data.item.__editable == false" class="btn btn-success">
                    <i class="fa fa-pencil"></i>
                </button>

                <button v-if="!noDelete" v-on:click="destroy(data.item)" v-bind:disabled="data.item.__deletable == false" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                </button>
            </template>

            <template slot="table-caption"> Menampilkan {{ items.length }} dari {{ totalRow }} data </template>
        </b-table>

        <b-pagination :per-page="localPerPage" :total-rows="totalRow" v-model="currentPage"></b-pagination>

        <loading-overlay v-show='is_busy'></loading-overlay>

        <form-modal ok-title="Hapus" ok-variant="danger" ref="delete" v-bind:form="form" v-bind:title="title || `Hapus data`">
            Peringatan! Data yang dihapus tidak dapat dikembalikan kembali
        </form-modal>

        <form-modal ok-title="Simpan" ref="form" v-bind:form="form" v-bind:size="modalSize" v-bind:title="title || `Form`">
            <slot name="form"></slot>
        </form-modal>
    </div>
</template>

<script>
import bPagination from 'bootstrap-vue/es/components/pagination/pagination';
import bTable from 'bootstrap-vue/es/components/table/table';
import DataTableFilter       from './DataTableFilter.js';
import DataTableRowLimitter  from './DataTableRowLimitter.js';

import directives   from './directives';
import props        from './props';
import Form         from '../../form';
import debounce     from 'lodash.debounce';

export default {
    components: {
        bPagination,
        bTable,
        DataTableFilter,
        DataTableRowLimitter
    },
    directives,
    props,
    computed: {
        computedFields() {
            let fields = this.fields;

            if (!this.noIndex) {
                fields.unshift(this.indexField);
            }

            if (!this.noAction) {
                fields.push(this.actionField);
            }

            return fields;
        },
        sortDirection() {
            return this.localSortDesc ? 'desc': 'asc';
        },
        options() {
            return {
                bordered : true,
                hover    : true,
                striped  : false,
                showEmpty: true
            };
        },
        context() {
            return Object.assign({ apiUrl: this.url}, this.params)
        },
        scopedSlots() {
            return Object.keys(this.$scopedSlots);
        },
        hasForm() {
            return (this.$slots.form || this.$scopedSlots.form) && this.form;
        },
    },
    data() {
        return {
            currentPage  : 1,
            is_busy      : false,
            items        : [],
            localSortBy  : this.sortBy,
            localSortDesc: this.sortDesc,
            localPerPage : this.perPage,
            search       : this.filter,
            selected     : null,
            totalRow     : 0,
        }
    },
    methods: {
        provider(ctx) {
            return axios.get(this.url, {
                params: {
                    limit   : this.localPerPage,
                    page    : this.currentPage,
                    search  : this.search,
                    sortBy  : [
                        this.localSortBy,
                        this.sortDirection
                    ],
                    ... this.params
                }
            })
            .takeAtLeast(400)
            .then(response => {
                let meta = response.data.meta;

                if (meta) {
                    this.currentPage  = Number.parseInt(meta.current_page);
                    this.localPerPage = Number.parseInt(meta.per_page);
                    this.totalRow     = Number.parseInt(meta.total);
                }

                return response.data.data.map(this.dataMap) || [];
            })
            .catch(error => {
                this.exception(error);

                return [];
            });
        },
        refresh() {
            this.$refs.table.refresh();
        },
        doSearch: debounce(function (search) {
            this.$emit('update:filter', search);

            this.search = search;
        }, 300),
        onDoubleClick(item, row, event) {
            this.$emit('dt:row-double-click', item, row, event);

            this.$emit('input', item);

            this.toggleSelected(item);

            this.onDoubleClicked(item, row, event);
        },
        toggleSelected(item, row) {
            let rows = this.$refs.table.$el.querySelectorAll('tbody tr');

            rows.forEach(function (child, index) {
                if (index == row) {
                    child.classList.add('active');
                } else {
                    child.classList.remove('active');
                }
            });

            this.$set(this, 'selected', item);
        },
        create() {
            this.$emit('dt:item-create');

            if (!this.hasForm) {
                return;
            }

            this.$refs.form.post(this.postUrl || this.url)
                .then(response => this.response(response))
                .catch(error => this.exception(error));
        },
        destroy(item) {
            this.$emit('dt:item-destroy', item);

            this.form.assign(item);

            this.$refs.delete.delete(item.path)
                .then(response => this.response(response))
                .catch(error => this.exception(error));
        },
        edit(item) {
            this.$emit('dt:item-edit', item);

            if (!this.hasForm) {
                return
            }

            this.form.assign(item);

            this.$refs.form.put(item.path)
                .then(response => this.response(response))
                .catch(error => this.exception(error));
        },
        response({ data }) {
            window.flash(data.message, data.status);

            this.refresh();
        },
        exception(error) {
            if (error.response.status === 401) {
                window.location.reload();
            }

            let response = error.response
            let data     = error.response.data;

            switch(true) {
                case data.message:
                    window.flash(data.message, 'error', 10000);
                    break;
                case response.status < 500:
                    window.flash(response.statusText, 'error', 10000);
                    break;
                default:
                    window.flash('Something went wrong!', 'error', 10000);
                    break;
            }

        },
        clearSelected() {
            this.selected = null;

            let rows = this.$refs.table.$el.querySelectorAll('tbody tr');

            rows.forEach((child, index) => child.classList.remove('active'));
        }
    },
    watch: {
        localPerPage(value) {
            this.$emit('update:perPage', value);
        },
        perPage(value) {
            this.localPerPage = value;
        },
        localSortBy(value) {
            this.$emit('update:sortBy', value);
        },
        sortBy(value) {
            this.localSortBy = value;
        },
        localSortDesc(value) {
            this.$emit('update:sortDesc', value);
        },
        sortDesc(value) {
            this.localSortDesc = value;
        },
        context(value) {
            this.refresh();
        },
        filter(value) {
            this.search = value;
        },
    },
}
</script>

<style lang="scss">
    .DataTable {
        position: relative;
    }

    .DataTable  tbody .active {
        background-color: #f0f3f5 !important;
    }

    .DataTable__limit {
        display: flex;

        label {
            line-height: 35px;
            margin     : 0 1em 0 0;
            width      : 9em;
        }
    }
</style>