@extends('layouts.base')

@section('app-class', 'flex-row align-items-center')

@section('app')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <bs-alert
                    message="{{ session('alert-message') }}"
                    type="{{ session('alert-type') }}"></bs-alert>

                @yield('content')
            </div>
        </div>
    </div>
@endsection

@push('plugins-css')
    <link rel="stylesheet" href="{{ asset(mix('css/simple-line-icons.css')) }}">
@endpush