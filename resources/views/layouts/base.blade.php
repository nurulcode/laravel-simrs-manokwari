<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <link rel="stylesheet" href="{{ asset(mix('css/preloader.css')) }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Setyo Nugroho (setyo@pm.me)">

    @stack('meta-tag')

    {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
    {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @stack('plugins-css')

    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

    @stack('css')

    <script> window.pagemix = []; </script>
    <script> window.inlines = {}; </script>

    <title>@yield('title') &mdash; {{ config('app.name') }}</title>
</head>
<body class="@yield('body-class')">
    <noscript> <h4>You need to enable JavaScript to run this app. </h4></noscript>

    <div id='app' class="app @yield('app-class')">
        @include('shared.preloader') @yield('app')
    </div>

    @stack('plugins-javascript')

    {{-- WebPack --}}
    <script src="{{ asset(mix('/js/manifest.js')) }}"></script>
    <script src="{{ asset(mix('/js/vendor.js')) }}"></script>

    @stack('javascripts')

    <script src="{{ asset(mix('/js/app.js')) }}"></script>
</body>
</html>