
<data-table v-bind.sync="resep" ref="table_resep" title="Resep" no-action no-add-button-text>
    <template slot="obat" slot-scope="{value, item}" v-if="value">
        @{{ value.uraian }}
    </template>
    <template slot="jumlah" slot-scope="{value, item}">
        @{{ value }} <span class="text-muted">@{{ item.obat.satuan }}</span>
    </template>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            resep: {
                url   : `{{ action('Layanan\ResepDetailController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'obat',
                },{
                    key      : 'jumlah'
                }, {
                    key      : 'petugas',
                    formatter: petugas => petugas && petugas.nama
                }]
            }
        }
    },
});
</script>
@endpush