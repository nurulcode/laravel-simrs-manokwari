<data-table v-bind.sync="utdrs" ref="table_utdrs" no-action no-add-button-text >
    <button
        class="btn btn-primary"
        slot-scope="{item}"
        slot="action"
        v-on:click="setTarif(item.uraian, item.tarif, 'table_utdrs')">
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
            utdrs: {
                sortBy: `uraian`,
                url   : `{{ action('Master\UtdrsController@index') }}`,
                fields: [{
                    key      : 'kode',
                    sortable : true,
                },{
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
