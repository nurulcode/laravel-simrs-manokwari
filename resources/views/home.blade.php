@extends('layouts.coreui')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            @component('components.card', ['class' => 'text-white bg-info'])
                <div class="h1 text-muted text-right mb-4">
                    <i class="icon-people"></i>
                </div>
                <div class="text-value">{{ $pasiens->count() }}</div>
                <small class="text-muted text-uppercase font-weight-bold">
                    Total Pasien Terdaftar
                </small>
            @endcomponent
        </div>
        <div class="col">
            @component('components.card', ['class' => 'text-white bg-info'])
                <div class="h1 text-muted text-right mb-4">
                    <i class="icon-user-follow"></i>
                </div>
                <div class="text-value">{{ $pasiens->hariIni()->count() }}</div>
                <small class="text-muted text-uppercase font-weight-bold">
                    Total Pasien Baru Hari Ini
                </small>
            @endcomponent
        </div>
        <div class="col">
            @component('components.card', ['class' => 'text-white bg-success'])
                <div class="h1 text-muted text-right mb-4">
                    <i class="icon-calendar "></i>
                </div>
                <div class="text-value">{{ with(clone $kunjungans)->count() }}</div>
                <small class="text-muted text-uppercase font-weight-bold">
                    Total Kunjungan
                </small>
            @endcomponent
        </div>
        <div class="col">
            @component('components.card', ['class' => 'text-white bg-primary'])
                <div class="h1 text-muted text-right mb-4">
                    <i class="icon-calendar "></i>
                </div>
                <div class="text-value">{{ with(clone $kunjungans)->hariIni()->count() }}</div>
                <small class="text-muted text-uppercase font-weight-bold">
                    Kunjungan Baru Hari Ini
                </small>
            @endcomponent
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            @component('components.card', ['class' => 'text-white bg-primary'])
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-stethoscope"></i>
                </div>
                <div class="text-value">{{ $rawat_jalan->hariIni()->count() }}</div>
                <small class="text-muted text-uppercase font-weight-bold">
                    Rawat Jalan Hari Ini
                </small>
            @endcomponent
        </div>
        <div class="col">
            @component('components.card', ['class' => 'text-white bg-danger'])
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-stethoscope"></i>
                </div>
                <div class="text-value">{{ $rawat_darurat->hariIni()->count() }}</div>
                <small class="text-muted text-uppercase font-weight-bold">
                    Rawat Darurat Hari Ini
                </small>
            @endcomponent
        </div>
        <div class="col">
            @component('components.card', ['class' => 'text-white bg-warning'])
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-stethoscope"></i>
                </div>
                <div class="text-value">{{ $rawat_inap->hariIni()->count() }}</div>
                <small class="text-muted text-uppercase font-weight-bold">
                    Rawat Inap Hari Ini
                </small>
            @endcomponent
        </div>
        <div class="col">
            @component('components.card', ['class' => 'text-white bg-success'])
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-stethoscope"></i>
                </div>
                <div class="text-value">{{ with(clone $ranjangs)->terisi()->count() }} dari {{ with(clone $ranjangs)->count() }}</div>
                <small class="text-muted text-uppercase font-weight-bold">
                    Ranjang Terisi
                </small>
            @endcomponent
        </div>
    </div>
@endsection
