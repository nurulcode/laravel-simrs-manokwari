@extends('layouts.coreui')

@section('title', 'Pasien Rawat Darurat')

@section('content')

@component('kunjungan.banner', ['kunjungan' => $kunjungan, 'title' => $title])
    @if (!$perawatan->waktu_keluar)
        @slot('footer')
            <button v-on:click="pulang" class="btn btn-warning">Pasien Pulang/Selesai</button>
        @endslot
    @else
        @slot('footer')
            {{ $perawatan->waktu_keluar }}: {{ App\Enums\KondisiAkhir::getDescription($perawatan->kondisi_akhir) }}
        @endslot
    @endif
@endcomponent

<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Penunjang"> @include('layanan.penunjang') </b-tab>
        <b-tab title="Diagnosa" active> @include('layanan.diagnosa') </b-tab>
        <b-tab title="Tindakan/Pemeriksaan"> @include('layanan.tindakan') </b-tab>
        <b-tab title="Pemeriksaan Umum"> @include('layanan.pemeriksaan') </b-tab>
        <b-tab title="Resep"> @include('layanan.resep') </b-tab>
    </b-tabs>
</b-card>

<form-modal ok-title="Simpan" ref="form_pulang" :form="form_pulang" title="Pasien Pulang">
    <b-form-group v-bind="form_pulang.feedback('waktu_keluar')">
        <b slot="label">Waktu Keluar:</b>
        <date-picker
            alt-format="d/m/Y H:i"
            enable-time
            v-model="form_pulang.waktu_keluar"
            v-on:input="form_pulang.errors.clear('waktu_keluar')"
            >
        </date-picker>
    </b-form-group>
    <b-form-group v-bind="form_pulang.feedback('kondisi_akhir')">
        <b slot="label">Kondisi Akhir:</b>
        <b-form-select
            :options="{{ json_encode(App\Enums\KondisiAkhir::toSelectOptions()) }}"
            v-on:change="form_pulang.errors.clear('kondisi_akhir')"
            v-model="form_pulang.kondisi_akhir">
            <option slot="first" :value="null" disabled>Pilih Kondisi Akhir Pasien</option>
        </b-form-select>
    </b-form-group>
</form-modal>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            form_pulang: new Form({
                waktu_keluar : null,
                kondisi_akhir: null,
            })
        };
    },
    methods: {
        pulang() {
            this.form_pulang.waktu_keluar = format(new Date(), 'YYYY-MM-DD HH:mm:ss');

            this.$refs.form_pulang.post(
                `{{ action('Perawatan\RawatDaruratPulangController', $perawatan->id) }}`
            ).then(response => {
                window.location.reload();
            });
        }
    }
});
</script>
@endpush