<data-table v-bind.sync="oksigen" ref="table_oksigen" no-action no-add-button-text >
    <template slot="action" slot-scope="{item}">
        <button
            class="btn btn-primary"
            v-on:click="setTarif(item.uraian, item.tarif, 'table_oksigen')">
            Ubah Tarif
        </button>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            oksigen: {
                sortBy: `uraian`,
                url   : `{{ action('Master\OksigenController@index') }}`,
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
