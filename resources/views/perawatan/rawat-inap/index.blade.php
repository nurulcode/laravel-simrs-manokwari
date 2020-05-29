@extends('layouts.single-card')

@section('title', 'Rawat Inap Management')

@section('card')
    <data-table v-bind.sync="perawatan" ref="table" no-action v-on:dt:item-create="create">
        <template slot="view" slot-scope="{item}">
            <a :href="`{{ $index }}/${item.id}`"
                class="btn btn-primary"> <i class="icon-eye"></i>
            </a>
        </template>
        <template slot="nomor_kunjungan" slot-scope="{item}">
            @{{ item.kunjungan.nomor_kunjungan }}
        </template>
        <template slot="pasien" slot-scope="{item}">
            @{{ item.kunjungan.pasien.nama }}
            <p class="text-muted">@{{ item.kunjungan.pasien.no_rekam_medis }}</p>
        </template>
        <template slot="waktu_masuk" slot-scope="{value}" v-if="value">
            @{{ value | date_time }}
        </template>
        <template slot="waktu_keluar" slot-scope="{value}" v-if="value">
            @{{ value | date_time }}
        </template>
        <template slot="ranjang" slot-scope="{item}">
            @{{ item.ruangan.nama }} - @{{ item.kamar.nama }}
            <p class="text-muted">Ranjang: @{{ item.ranjang.kode }}</p>
        </template>

    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            perawatan: {
                sortBy  : `waktu_masuk`,
                sortDesc: true,
                url     : `{{ $api }}`,
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
                    key      : 'waktu_masuk',
                    sortable : true,
                    thStyle  : {
                        'width': '180px'
                    }
                },{
                    key      : 'waktu_keluar',
                    sortable : true,
                    thStyle  : {
                        'width': '180px'
                    }
                },{
                    label    : 'Kamar/Ranjang',
                    key      : 'ranjang',
                }, {
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
        create() {
            window.location.replace(`{{ $create }}`);
        }
    }
});
</script>
@endpush
