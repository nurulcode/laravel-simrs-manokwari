<data-table v-bind.sync="gizi" ref="table_gizi" no-action no-add-button-text >
    <template slot="action" slot-scope="{item}">
        <button
            class="btn btn-primary"
            v-on:click="setTarif(item.uraian, item.tarif, 'table_gizi')">
            Ubah Tarif
        </button>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            gizi: {
                sortBy: `uraian`,
                url   : `{{ action('Master\GiziController@index') }}`,
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
