@extends('layouts.single-card')

@section('title', 'Pasien Management')

@section('card')
    <div class="row">
        <div class="col">
            <div class="b-form-group form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:120px">Nomor MR</span>
                    </div>
                    <input placeholder="Search MR" type="text" class="form-control" v-model='pasien.params.mr'>
                    <div class="input-group-append">
                        <button v-if="!pasien.params.mr" title="Cari..." type="button" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                        <button v-else title="Clear" type="button" class="btn btn-secondary"
                            v-on:click="pasien.params.mr = ''">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="b-form-group form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:70px">Nama</span>
                    </div>
                    <input placeholder="Search Nama" type="text" class="form-control" v-model='pasien.params.nama'>
                    <div class="input-group-append">
                        <button v-if="!pasien.params.nama" title="Cari..." type="button" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                        <button v-else title="Clear" type="button" class="btn btn-secondary"
                            v-on:click="pasien.params.nama = ''">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="b-form-group form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">No. Identitas</span>
                    </div>
                    <input placeholder="Search Nomor Identitas" type="text" class="form-control" v-model='pasien.params.noidentitas'>
                    <div class="input-group-append">
                        <button v-if="!pasien.params.noidentitas" title="Cari..." type="button" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                        <button v-else title="Clear" type="button" class="btn btn-secondary"
                            v-on:click="pasien.params.noidentitas = ''">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row  mb-4">
        <div class="col-md-4">
            <div class="b-form-group form-group">
                <date-picker
                    alt-format="d/m/Y"
                    :max-date="new Date()"
                    v-model="pasien.params.tanggal_lahir"
                    v-on:input="form_pasien.errors.clear('tanggal_lahir')">

                    <div class="input-group-prepend" slot="prepend">
                        <span class="input-group-text" style="width:120px">Tanggal Lahir</span>
                    </div>
                    <div class="input-group-append" slot="append" v-if="pasien.params.tanggal_lahir">
                        <button type="button" class="btn btn-secondary" v-on:click.prevent="pasien.params.tanggal_lahir = null">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </date-picker>
            </div>
        </div>
        <div class="col">
            <div class="b-form-group form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:70px">Alamat</span>
                    </div>
                    <input placeholder="Search Alamat" type="text" class="form-control" v-model='pasien.params.alamat'>
                    <div class="input-group-append">
                        <button v-if="!pasien.params.alamat" title="Cari..." type="button" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                        <button v-else title="Clear" type="button" class="btn btn-secondary"
                            v-on:click="pasien.params.alamat = ''">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <data-table v-bind.sync="pasien" ref="table" modal-size="lg" :form="form_pasien" no-index>
        <div slot="form"> @include('pasien-form') </div>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            pasien: {
                sortBy  : `no_rekam_medis`,
                sortDesc: true,
                params  : {
                    mr           : null,
                    nama         : null,
                    noidentitas  : null,
                    tanggal_lahir: null,
                    alamat       : null
                },
                url     : `{{ action('PasienController@index') }}`,
                fields: [{
                    key      : 'no_rekam_medis',
                    sortable : true,
                },{
                    key      : 'nama',
                    sortable : true,
                },{
                    key      : 'nomor_identitas',
                },{
                    key      : 'tanggal_lahir',
                    formatter: value => format(parse(value), 'DD/MM/YYYY')
                },{
                    key      : 'alamat',
                }]
            },
        }
    },
});
</script>
@endpush
