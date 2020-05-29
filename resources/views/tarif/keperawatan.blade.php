<data-table v-bind.sync="keperawatan" ref="table_keperawatan" no-action no-add-button-text >
    <template slot="uraian" slot-scope="{item, value}">
        @{{ value }}
        <p class="text-muted" v-if="value.parent">
            @{{ value.parent.uraian }}
        </p>
    </template>
    <template slot="action" slot-scope="{item}">
        <button
            class="btn btn-primary"
            v-on:click="setTarif(item.uraian, item.tarif, 'table_keperawatan')">
            Ubah Tarif
        </button>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            keperawatan: {
                sortBy: `kode`,
                url   : `{{ action('Master\PerawatanKhususController@index') }}`,
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
