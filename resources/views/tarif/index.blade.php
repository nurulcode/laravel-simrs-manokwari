@extends('layouts.coreui')

@section('title', 'Tarif Management')

@section('content')
<b-tabs lazy no-fade>
    <b-tab title="Ruangan"> @include('tarif.ruangan') </b-tab>
    <b-tab title="Tindakan/Pemeriksaan"> @include('tarif.tindakan') </b-tab>
    <b-tab title="Kegiatan"> @include('tarif.kegiatan') </b-tab>
    <b-tab title="Visite"> @include('tarif.visite') </b-tab>
    <b-tab title="Perawatan Khusus"> @include('tarif.keperawatan') </b-tab>
    <b-tab title="Oksigen"> @include('tarif.oksigen') </b-tab>
    <b-tab title="Gizi"> @include('tarif.gizi') </b-tab>
    <b-tab title="Laundry"> @include('tarif.laundry') </b-tab>
    <b-tab title="Insenerator"> @include('tarif.insenerator') </b-tab>
    <b-tab title="UTDRS"> @include('tarif.utdrs') </b-tab>
    <b-tab title="Pemeriksaan Jenazah"> @include('tarif.pemeriksaan-jenazah') </b-tab>
    <b-tab title="Registrasi" active> @include('tarif.registrasi') </b-tab>
</b-tabs>

<form-modal ok-title="Simpan" ref="form" :form="form" size="lg" title="Ubah Tarif">
    <b-form-group label="Ubah Tarif:">
        <input
            class="form-control"
            disabled
            placeholder="Edite"
            type="text"
            :value="edite"
            >
        </input>
    </b-form-group>
    <template v-for="kelas in Object.keys(form.tarif)">
        <hr>
        <h6>@{{ kelas_tarif[kelas] }}</h6>
        <div class="row">
            @foreach (App\Enums\JenisTarif::getValues() as $kelas)
                <div class="col">
                    <b-form-group label="{{ App\Enums\JenisTarif::getDescription($kelas) }}:">
                        <input
                            class="form-control"
                            type="number"
                            min="0"
                            step="100"
                            v-on:mousewheel="mouseWheel"
                            v-model="form.tarif[kelas].{{ $kelas }}"
                            >
                        </input>
                    </b-form-group>
                </div>
            @endforeach
        </div>
    </template>
</form-modal>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            form: new Form({
                tarifable_type: null,
                tarifable_id  : null,
                tarif: {}
            }),
            edite: '',
            kelas_tarif: @json(App\Enums\KelasTarif::keyDescriptions())
        }
    },
    methods: {
        setTarif(title, tarif, table) {
            this.edite = title;

            this.form.assign(tarif);

            this.$refs.form.post(`{{ action('StoreTarifController') }}`)
                .then(response => {
                    window.flash(response.data.message, response.data.status);

                    this.$refs[table].refresh();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        mouseWheel(e) {
            console.log(e);

        }
    }
});
</script>
@endpush