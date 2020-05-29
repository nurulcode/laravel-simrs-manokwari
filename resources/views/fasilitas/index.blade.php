@extends('layouts.tabs')

@section('title', 'Fasilitas Management')

@section('tabs')

<b-tab title="Poliklinik">
    @include('fasilitas.poliklinik')
</b-tab>

<b-tab title="Ruangan">
    @include('fasilitas.ruangan')
</b-tab>

<b-tab title="Kamar">
    @include('fasilitas.kamar')
</b-tab>

<b-tab title="Ranjang">
    @include('fasilitas.ranjang')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_poliklinik: null,
            selected_ruangan   : null,
            selected_kamar     : null,
        }
    },
    watch: {
        selected_poliklinik(value) {
            this.ruangan.params.poliklinik = value && value.id;

            this.ruangan.form.setDefault('poliklinik', value);

            this.ruangan.form.setDefault('poliklinik_id', value && value.id);

            this.selected_tab = value ? 1 : this.selected_tab;
        },
        selected_ruangan(value) {
            this.kamar.params.ruangan = value && value.id;

            this.kamar.form.setDefault('ruangan', value);

            this.kamar.form.setDefault('ruangan_id', value && value.id);

            this.kamar.form.setDefault('poliklinik', value && value.poliklinik);

            this.kamar.form.setDefault('poliklinik_id', value && value.poliklinik_id);

            this.selected_tab = value ? 2 : this.selected_tab;
        },
        selected_kamar(value) {
            this.ranjang.params.kamar = value && value.id;

            this.ranjang.form.setDefault('kamar', value);

            this.ranjang.form.setDefault('kamar_id', value && value.id);

            this.ranjang.form.setDefault('ruangan', value && value.ruangan);

            this.ranjang.form.setDefault('ruangan_id', value && value.ruangan_id);

            this.ranjang.form.setDefault('poliklinik', value && value.poliklinik);

            this.ranjang.form.setDefault('poliklinik_id', value && value.poliklinik_id);

            this.selected_tab = value ? 3 : this.selected_tab;
        }
    }
});
</script>
@endpush
