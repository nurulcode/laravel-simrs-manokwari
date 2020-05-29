<data-table v-bind.sync="laundry" ref="table_laundry" no-action no-add-button-text >
    <template slot="action" slot-scope="{item}">
        <button
            class="btn btn-primary"
            v-on:click="setTarif(item.uraian, item.tarif, 'table_laundry')">
            Ubah Tarif
        </button>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            laundry: {
                sortBy: `uraian`,
                url   : `{{ action('Master\JenisLaundryController@index') }}`,
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
