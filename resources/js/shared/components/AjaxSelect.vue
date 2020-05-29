<template>
    <multiselect
        @search-change="doSearch"
        @input="onSelect"
        :label="label"
        :loading="!loaded"
        :options="data"
        :options-limit="optionsLimit"
        :internal-search="internalSearch"
        :trackBy="trackBy"
        :value="value"
        v-bind="$attrs"
        >
        <template v-for="sslot in scopedSlots" :slot='sslot' slot-scope="data">
            <slot v-bind="data" :name="sslot"> {{ data }} </slot>
        </template>
    </multiselect>
</template>

<script>
import debounce from 'lodash.debounce';

export default {
    computed: {
        scopedSlots() {
            return Object.keys(this.$scopedSlots);
        },
        sort() {
            return this.sortBy || this.label;
        }
    },
    data() {
        return {
            loaded  : false,
            data    : [],
            search  : ''
        }
    },
    methods: {
        doSearch: debounce(function (query) {
            if (!this.internalSearch) {
                this.search = `${query}`;
            }
        }, 300),
        refresh: function () {
            this.loadData();
        },
        loadData() {
            this.loaded = false;

            axios.get(this.url, {
                params: {
                    limit : this.optionsLimit,
                    search: this.search,
                    sortBy: this.sort,

                    ...this.params
                }
            })
            .then(response => {
                this.data   = response.data.data.map(this.dataMap).filter(this.filter) || [],
                this.loaded = true;
            })
            .catch(error => {
                this.loaded = true;
            })
        },
        onSelect(value) {
            this.$emit('select', value);
            this.$emit('input', value);
        }
    },
    mounted() {
        this.loadData()
    },
    watch: {
        search(value, before) {
            this.loadData();
        },
        url(value, before) {
            this.refresh();
        },
        params: {
            handler: function (options, before) {
                if (JSON.stringify(options) != JSON.stringify(before)) {
                    this.refresh()
                }
            },
        },
        value(value, before) {
            if (value instanceof Object) {
                this.$emit('update:keyValue', value[this.trackBy]);
            } else {
                this.$emit('update:keyValue', value);
            }

            this.$emit('change', value, before);
        }
    },
    props: {
        dataMap: {
            type    : Function,
            required: false,
            default : function (item) {
                return item;
            }
        },
        filter: {
            type    : Function,
            required: false,
            default : function (item) {
                return true;
            }
        },
        internalSearch: {
            type   : Boolean,
            default: false
        },
        label: {
            type   : String,
            default: 'name'
        },
        optionsLimit: {
            type   : Number,
            default: 50
        },
        params: {
            type    : Object,
            default : () => ({}),
            required: false
        },
        trackBy: {
            type   : String,
            default: 'id'
        },
        url: {
            type    : String,
            required: true
        },
        value: {
            type   : [Object, String, Number, Array],
            required: false
        },
        keyValue: {
            type   : [String, Number],
            required: false
        },
        sortBy: {
            type    : String,
            required: false
        }
    }
}
</script>