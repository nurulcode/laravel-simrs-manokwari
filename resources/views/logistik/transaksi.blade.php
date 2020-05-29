<data-table v-bind.sync="transaksi" ref="table" no-action no-add-button-text> </data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            transaksi: {
                url     : `{{ action('Logistik\TransaksiController@index') }}`,
                sortBy  : `created_at`,
                sortDesc: true,
                fields: [{
                    key      : 'jenis',
                    formatter: jenis => jenis ? jenis : 'Koreksi'
                },{
                    key      : 'logistik',
                    formatter: logistik => logistik ? logistik.uraian : ''
                }, {
                    key      : 'apotek',
                    formatter: apotek => apotek ? apotek.nama : ''
                }, {
                    key      : 'jumlah',
                }],
            }
        }
    },
});
</script>
@endpush
