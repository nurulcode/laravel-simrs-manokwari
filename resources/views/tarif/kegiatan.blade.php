<data-table v-bind.sync="kegiatan" ref="table_kegiatan" no-action no-add-button-text >
        <template slot="uraian" slot-scope="{item, value}">
            @{{ item.uraian }}
            <span class="text-muted" v-if="item.parent">&nbsp;- @{{ item.parent.uraian }}</span>
            <p>
                <b-badge
                    v-for="kat in item.kategori"
                    class="mr-1"
                    variant="success"
                    v-bind:key="kat.pivot_id"
                    v-text="`${kat.kode} : ${kat.uraian}`"
                    >
                </b-badge>
            </p>
        </template>
        <div slot="before-top-button" class="mr-3" style="width: 240px">
            <ajax-select
                deselect-label=""
                label="uraian"
                url="{{ action('Master\KategoriKegiatanController@index') }}"
                select-label=""
                placeholder="Filter by Kategori"
                v-bind:key-value.sync="kegiatan.params.kategori"
                v-model="kegiatan.kategori"
                >
            </ajax-select>
        </div>
        <template slot="action" slot-scope="{item}">
            <button
                class="btn btn-primary"
                v-on:click="setTarif(item.uraian, item.tarif, 'table_kegiatan')">
                Ubah Tarif
            </button>
        </template>
    </data-table>


    @push('javascripts')
    <script>
    window.pagemix.push({
        data() {
            return {
                kegiatan: {
                    sortBy: `uraian`,
                    url   : `{{ action('Master\KegiatanController@index') }}`,
                    params: {
                        kategori: null
                    },
                    kategori: null,
                    fields: [{
                        key      : 'uraian',
                        sortable : true,
                    },{
                        key      : 'action',
                        label    : 'Ubah Tarif',
                        class    : 'text-center'
                    }],
                }
            }
        },
    });
    </script>
    @endpush
