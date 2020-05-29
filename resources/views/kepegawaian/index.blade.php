@extends('layouts.tabs')

@section('title', 'Kepegawaian Data Management')

@section('tabs')

<b-tab title="Daftar Pegawai">
    @include('kepegawaian.pegawai')
</b-tab>

<b-tab title="Jabatan">
    @include('kepegawaian.jabatan')
</b-tab>

<b-tab title="Kategori Kualifikasi">
    @include('kepegawaian.kategori')
</b-tab>

<b-tab title="Kualifikasi">
    @include('kepegawaian.kualifikasi')
</b-tab>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_kategori   : null,
            selected_jabatan    : null,
            selected_kualifikasi: null
        }
    },
    watch: {
        selected_jabatan(value) {
            this.pegawai.params.jabatan  = value && value.id;

            this.pegawai.form.setDefault('jabatan', value);

            this.pegawai.form.setDefault('jabatan_id', value && value.id);

            this.selected_tab = value ? 0 : this.selected_tab;
        },
        selected_kualifikasi(value) {
            this.pegawai.params.kualifikasi = value && value.id;

            this.pegawai.form.setDefault('kualifikasi', value);

            this.pegawai.form.setDefault('kualifikasi_id', value && value.id);

            this.selected_tab = value ? 0 : this.selected_tab;
        },
        selected_kategori(value) {
            this.kualifikasi.params.kategori = value && value.id;

            this.kualifikasi.sortBy = value ? 'id' : 'kategori_id';

            this.kualifikasi.form.setDefault('kategori', value);

            this.kualifikasi.form.setDefault('kategori_id', value && value.id);

            this.selected_tab = value ? 3 : this.selected_tab;
        },
    }
});
</script>
@endpush
