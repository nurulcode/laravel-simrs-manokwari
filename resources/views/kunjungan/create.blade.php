@extends('layouts.single-card')

@section('header')

<div class="row">
    <div class="col">
        <h6 class="mr-auto mb-0" style="line-height: 33px"> @yield('title') </h6>
    </div>
    <div class="col text-right">
        <button class="btn btn-brand btn-spotify" v-on:click.stop="createPasien">
            <i class="fa fa-plus"></i> <span>Pasien Baru</span>
        </button>
    </div>
</div>

@endsection

@section('card')

<form-modal ok-title="Simpan" ref="formpasien" v-bind:form="form_pasien" size="lg" title="Pasien Baru">
    @include('pasien-form')
</form-modal>

<form id="kunjungan" method="POST" action="@yield('action')"
    v-on:submit.prevent="submit"
    v-on:keydown="e => form_kunjungan.errors.clear(e.target.name)">

    <pasien-picker
        :data-pasien.sync="form_kunjungan.pasien"
        :feedback="form_kunjungan.feedback('pasien_id')"
        url="{{ action('PasienController@index') }}"
        v-model="form_kunjungan.pasien_id"
        v-on:change="form_kunjungan.errors.clear('pasien_id')">
    </pasien-picker>

    <hr>

    @include('kunjungan.form')

    <hr>

    @yield('form')
</form>

<loading-overlay v-show="form_kunjungan.is_loading"></loading-overlay>

@endsection

@section('footer')

    <button form="kunjungan" type="submit" class="btn btn-primary"> Simpan </button>

@endsection

@push('javascripts')

<script>
window.pagemix.push({
    methods: {
        createPasien(e) {
            this.$refs.formpasien.post(`{{ action('PasienController@store') }}`)
                .then(response => {
                    if (response.status == 201) {
                        this.form_kunjungan.pasien_baru = true;
                        this.form_kunjungan.pasien      = response.data.data;
                        this.form_kunjungan.pasien_id   = response.data.data.id;
                    }
                })
                .catch(error => {
                    console.log(error.response);
                });
        }
    }
});
</script>

@endpush