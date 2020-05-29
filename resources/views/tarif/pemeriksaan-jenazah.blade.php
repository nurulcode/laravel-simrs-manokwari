<data-table v-bind.sync="pemeriksaan_jenazah" ref="table_pemeriksaan_jenazah" no-action no-add-button-text >
    <template slot="action" slot-scope="{item}">
        <button
            class="btn btn-primary"
            v-on:click="setTarif(item.uraian, item.tarif, 'table_pemeriksaan_jenazah')">
            Ubah Tarif
        </button>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            pemeriksaan_jenazah: {
                sortBy: `uraian`,
                url   : `{{ action('Master\PemeriksaanJenazahController@index') }}`,
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
