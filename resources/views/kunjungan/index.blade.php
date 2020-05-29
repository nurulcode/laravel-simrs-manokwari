@extends('layouts.single-card')

@section('title', 'Kunjungan Management')

@section('card')
    <data-table v-bind.sync="kunjungan" ref="table" no-action no-add-button-text>
        <template slot="view" slot-scope="{item: kunjungan}">
            <a :href="`{{ action('KunjunganWebController@index') }}/${kunjungan.id}`"
                class="btn btn-primary"> <i class="icon-eye"></i>
            </a>
        </template>
        <template slot="pasien" slot-scope="{value}">
            @{{ value.nama }}
            <p class="text-muted">@{{ value.no_rekam_medis }}</p>
        </template>
        <template slot="penyakit" slot-scope="{value: penyakit}" v-if="penyakit">
            @{{ `${penyakit.icd} - ${penyakit.uraian}` }}
        </template>
        <template slot="nomor_kunjungan" slot-scope="{value, item}">
            @{{ value }}
            <p class="text-muted">
                @{{ item.waktu_masuk | date_time }}
            </p>
        </template>
        <template slot="waktu_keluar" slot-scope="{value}" v-if="value">
            @{{ value | date_time }}
        </template>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            kunjungan: {
                sortBy  : `waktu_masuk`,
                sortDesc: true,
                url     : `{{ action('KunjunganController@index') }}`,
                fields: [{
                    key      : 'nomor_kunjungan',
                    sortable : true,
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'pasien',
                    thStyle  : {
                        'min-width': '200px'
                    }
                },{
                    key      : 'waktu_keluar',
                    sortable : true,
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'penyakit',
                    label    : 'Diagnosa Awal',
                    thStyle  : {
                        'min-width': '220px'
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
});
</script>
@endpush
