@extends('layouts.single-card')

@section('title', 'Apotek Pasien Perawatan')

@section('card')
    <data-table v-bind.sync="apotek" ref="table" no-action no-add-button-text>
        <template slot="view" slot-scope="{item}">
            <a :href="`{{ url()->current() }}/${item.id}`"
                class="btn btn-primary"> <i class="icon-eye"></i>
            </a>
        </template>
        <template slot="nomor_kunjungan" slot-scope="{item}" v-if="item.perawatan">
            @{{ item.perawatan.kunjungan.nomor_kunjungan }}
        </template>
        <template slot="waktu_masuk" slot-scope="{item}" v-if="item.perawatan">
            @{{ item.perawatan.waktu_masuk | date_time }}
        </template>
        <template slot="pasien" slot-scope="{item}" v-if="item.perawatan">
            @{{ item.perawatan.kunjungan.pasien.nama }}
            <p class="text-muted">
                @{{ item.perawatan.kunjungan.pasien.no_rekam_medis }}
            </p>
        </template>
        <template slot="poliklinik" slot-scope="{item}" v-if="item.perawatan">
            @{{ item.perawatan.poliklinik.kode }} - @{{ item.perawatan.poliklinik.nama }}
        </template>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            apotek: {
                sortDesc: true,
                url     : `{{ action('Layanan\\ResepController@index') }}`,
                fields: [{
                    key      : 'nomor_kunjungan',
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'waktu_masuk',
                },{
                    key      : 'pasien',
                    thStyle  : {
                        'min-width': '160px'
                    }
                },{
                    key      : 'waktu_masuk',
                    sortable : true,
                    thStyle  : {
                        'width': '180px'
                    }
                },{
                    key      : 'pasien',
                },{
                    key      : 'poliklinik',
                    label    : 'Ruang Pelayanan'
                },{
                    key      : 'view',
                    class    : 'text-center',
                    thStyle  : {
                        'width': '80px'
                    }
                }]
            }
        }
    },
    methods: {

    }
});
</script>
@endpush
