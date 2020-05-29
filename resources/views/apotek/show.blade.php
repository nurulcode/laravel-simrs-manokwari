@extends('layouts.coreui')

@section('title', $title)

@section('content')

@component('kunjungan.banner', ['kunjungan' => $kunjungan, 'title' => $title])

@endcomponent

<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Resep"> @include('apotek.resep') </b-tab>
        <b-tab title="Penggunaan Obat/Alkes"> @include('apotek.obat') </b-tab>
    </b-tabs>
</b-card>

@endsection