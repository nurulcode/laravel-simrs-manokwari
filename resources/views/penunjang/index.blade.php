@extends('layouts.single-card')

@section('title', $title ?? '')

@section('card')
    <data-table v-bind.sync="penunjang" ref="table" no-action no-add-button-text>
        <template slot="view" slot-scope="{item}">
            <a :href="`{{ url()->current() }}/${item.id}`"
                class="btn btn-primary"> <i class="icon-eye"></i>
            </a>
        </template>
        <template slot="nomor_kunjungan" slot-scope="{item}">
            @{{ item.perawatan.kunjungan.nomor_kunjungan }}
        </template>
        <template slot="waktu" slot-scope="{value}" v-if="value">
            @{{ value | date_time }}
        </template>
        <template slot="poliklinik" slot-scope="{value}">
            @{{ value.nama }}
        </template>
        <template slot="asal" slot-scope="{item}">
            @{{ item.perawatan.poliklinik.nama }}
        </template>
        <template slot="pasien" slot-scope="{item}">
            @{{ item.perawatan.kunjungan.pasien.nama }}
            <p class="text-muted">@{{ item.perawatan.kunjungan.pasien.no_rekam_medis }}</p>
        </template>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            penunjang: {
                sortBy  : `waktu`,
                sortDesc: true,
                url     : `{{ action('Layanan\\PenunjangController@index') }}`,
                params  : {
                    jenis: `{{ $jenis ?? '' }}`
                },
                fields: [{
                    key      : 'nomor_kunjungan',
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'pasien',
                    thStyle  : {
                        'min-width': '160px'
                    }
                },{
                    key      : 'asal',
                    label    : 'Poliklinik Asal'

                },{
                    key      : 'poliklinik',
                    label    : 'Fasilitas Tujuan'
                },{
                    key      : 'waktu',
                    sortable : true,
                    thStyle  : {
                        'width': '180px'
                    }
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
