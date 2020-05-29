<data-table v-bind.sync="insenerator" ref="table_insenerator" no-action no-add-button-text >
        <button
            class="btn btn-primary"
            slot-scope="{item}"
            slot="action"
            v-on:click="setTarif(item.uraian, item.tarif, 'table_insenerator')">
            Ubah Tarif
        </button>
        <template slot="uraian" slot-scope="{item, value}">
                @{{ value }}
                <p class="text-muted" v-if="item.parent">@{{ item.parent.uraian }}</p>
            </template>
    </data-table>


    @push('javascripts')
    <script>
    window.pagemix.push({
        data() {
            return {
                insenerator: {
                    sortBy: `uraian`,
                    url   : `{{ action('Master\InseneratorController@index') }}`,
                    fields: [{
                        key      : 'kode',
                        sortable : true,
                    },{
                        key      : 'uraian',
                        sortable : true,
                    },{
                        key      : 'satuan',
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
