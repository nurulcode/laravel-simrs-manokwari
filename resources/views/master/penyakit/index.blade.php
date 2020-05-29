@extends('layouts.tabs')

@section('title', 'Master Kegiatan Management')

@section('tabs')

<b-tab title="Klasifikasi Penyakit">
    @include('master.penyakit.klasifikasi')
</b-tab>

<b-tab title="Kelompok Penyakit">
    @include('master.penyakit.kelompok')
</b-tab>

<b-tab title="Penyakit">
    @include('master.penyakit.penyakit')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_klasifikasi: null,
            selected_kelompok   : null
        }
    },
    watch: {
        selected_klasifikasi(value) {
            this.kelompok.params.klasifikasi  = value && value.id;

            this.kelompok.sortBy = value ? 'uraian' : 'kode';

            this.kelompok.form.setDefault('klasifikasi', value);

            this.kelompok.form.setDefault('klasifikasi_id', value && value.id);

            this.selected_tab = value ? 1 : this.selected_tab;
        },
        selected_kelompok(value) {
            this.penyakit.params.kelompok  = value && value.id;

            this.penyakit.sortBy = value ? 'uraian' : 'icd';

            this.penyakit.form.setDefault('kelompok', value);

            this.penyakit.form.setDefault('kelompok_id', value && value.id);

            this.selected_tab = value ? 2 : this.selected_tab;
        }
    }
});
</script>
@endpush
