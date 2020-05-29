<data-table v-bind.sync="visite" ref="table_visite" no-action no-add-button-text >
        <template slot="action" slot-scope="{item}">
            <button
                class="btn btn-primary"
                v-on:click="setTarif(item.uraian, item.tarif, 'table_visite')">
                Ubah Tarif
            </button>
        </template>
    </data-table>


    @push('javascripts')
    <script>
    window.pagemix.push({
        data() {
            return {
                visite: {
                    sortBy: `uraian`,
                    url   : `{{ action('Master\JenisVisiteController@index') }}`,
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
