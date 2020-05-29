@extends('layouts.coreui')

@section('content')
    @component('components.card')

        @slot('header')
            @hasSection('header')
                @yield('header')
            @else
                @yield('title')
            @endif
        @endslot

        @yield('card')

        @slot('footer') @yield('footer') @endslot

    @endcomponent
@endsection