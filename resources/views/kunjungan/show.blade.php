@extends('layouts.coreui')

@section('title', 'Invoice Pasien')

@section('content')

    @include('kunjungan.banner', ['title' => $kunjungan->pasien->nama])

    @include('kunjungan.transaksi')

@endsection

@push('javascripts')

<script>
window.pagemix.push({
    data() {
        return {
            //
        }
    },
    methods: {
        //
    },
    mounted() {
        //
    }
});
</script>

@endpush