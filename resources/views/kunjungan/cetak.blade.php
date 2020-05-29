<?php use App\Enums\JenisTarif; ?>
@extends('layouts.cetak')

@section('title', 'Invoice Pasien')

@section('content')

<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2" class="align-middle text-center">Layanan/Sarana</th>
            <th rowspan="2" class="align-middle text-center">Jumlah</th>
            <th colspan="4" class="text-center">Tarif (Rp)</th>
            <th rowspan="2" class="align-middle text-center">Tanggungan</th>
            <th rowspan="2" class="align-middle text-center">Total</th>
        </tr>
        <tr>
            <th>Sarana</th>
            <th>Pelayanan</th>
            <th>BHP</th>
            <th>Total</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="8" class="font-weight-bold text-uppercase text-center">Registrasi</td>
        </tr>
        @foreach ($registrasis as $registrasi)
            <tr>
                <td>{{ $registrasi->jenis->uraian }}</td>
                <td class="text-right">1</td>
                <td class="text-right">{{ $registrasi->tarif[JenisTarif::SARANA] }}</td>
                <td class="text-right">{{ $registrasi->tarif[JenisTarif::PELAYANAN] }}</td>
                <td class="text-right">{{ $registrasi->tarif[JenisTarif::BHP] }}</td>
                <td class="text-right">{{ $registrasi->total_tarif }}</td>
                <td class="text-right">0</td>
                <td class="text-right">{{ $registrasi->total_tarif }}</td>
            </tr>
        @endforeach

        @each('kunjungan.perawatans', $perawatans, 'perawatan')
        <tr>
            <td colspan="7" class="font-weight-bold text-uppercase text-center">Total</td>
            <td class="text-right">{{ $kunjungan->getTotalBiaya() }}</td>
        </tr>
    </tbody>
</table>

@endsection

@push('javascripts')
<script>
window.onload = function() { window.print(); }
</script>
@endpush