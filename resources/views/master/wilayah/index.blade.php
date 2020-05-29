@extends('layouts.tabs')

@section('title', 'Master Wilayah Management')

@section('tabs')

<b-tab title="Provinsi">
    @include('master.wilayah.provinsi')
</b-tab>

<b-tab title="KotaKabupaten">
    @include('master.wilayah.kotakabupaten')
</b-tab>

<b-tab title="Kecamatan">
    @include('master.wilayah.kecamatan')
</b-tab>

<b-tab title="Kelurahan">
    @include('master.wilayah.kelurahan')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_provinsi      : null,
            selected_kota_kabupaten: null,
            selected_kecamatan     : null,
        }
    },
    watch: {
        selected_provinsi(value) {
            this.kota_kabupaten.params.provinsi = value && value.id;

            this.kota_kabupaten.form.setDefault('provinsi', value);

            this.kota_kabupaten.form.setDefault('provinsi_id', value && value.id);

            this.selected_tab = value ? 1 : this.selected_tab;

            this.kota_kabupaten.sortBy = value ? 'name' : 'provinsi';
        },
        selected_kota_kabupaten(value) {
            this.kecamatan.params.kota_kabupaten = value && value.id;

            this.selected_tab = value ? 2 : this.selected_tab;

            this.kecamatan.sortBy = value ? 'name' : 'provinsi';

            this.kecamatan.form.setDefault('kota_kabupaten', value);

            this.kecamatan.form.setDefault('kota_kabupaten_id', value && value.id);

            this.kecamatan.form.setDefault('provinsi', value && value.provinsi);

            this.kecamatan.form.setDefault('provinsi_id', value && value.provinsi_id);
        },
        selected_kecamatan(value) {
            this.selected_tab = value ? 3 : this.selected_tab;

            this.kelurahan.sortBy = value ? 'name' : 'provinsi';

            this.kelurahan.params.kecamatan = value && value.id;

            this.kelurahan.form.setDefault('kecamatan', value);

            this.kelurahan.form.setDefault('kecamatan_id', value && value.id);

            this.kelurahan.form.setDefault('kota_kabupaten', value && value.kota_kabupaten);

            this.kelurahan.form.setDefault('kota_kabupaten_id', value && value.kota_kabupaten_id);

            this.kelurahan.form.setDefault('provinsi', value && value.provinsi);

            this.kelurahan.form.setDefault('provinsi_id', value && value.provinsi_id);
        }
    }
});
</script>
@endpush
