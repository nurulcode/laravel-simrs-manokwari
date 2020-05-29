<data-table v-bind.sync="ruangan" ref="table_ruangan" no-action no-add-button-text >
    <template slot="jenis" slot-scope="{value}">
        @{{ ruangan.jenis[value] }}
    </template>
    <template slot="kelas" slot-scope="{value}">
        @{{ ruangan.kelas[value] }}
    </template>
    <template slot="action" slot-scope="{item}">
        <button
            class="btn btn-primary"
            v-on:click="setTarif(item.nama, item.tarif, 'table_ruangan')">
            Ubah Tarif
        </button>
    </template>
</data-table>


    @push('javascripts')
    <script>
    window.pagemix.push({
        data() {
            return {
                ruangan: {
                    jenis : @json(App\Enums\JenisRuangan::toSelectArray()),
                    kelas : @json(App\Enums\KelasRuangan::toSelectArray()),
                    sortBy: `poliklinik`,
                    url   : `{{ action('Fasilitas\RuanganController@index') }}`,
                    fields: [{
                        key      : 'poliklinik',
                        sortable : true,
                        formatter: item => item.nama
                    },{
                        key      : 'kode',
                        sortable : true,
                        formatter: item => item.toUpperCase()
                    },{
                        key      : 'nama',
                        sortable : true,
                    }, {
                        key      : 'kelas',
                    },{
                        key      : 'jenis'
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
