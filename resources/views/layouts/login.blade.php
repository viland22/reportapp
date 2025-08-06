<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-skin="default"
    data-assets-path="{{ asset('') }}" data-template="vertical-menu-template" data-bs-theme="light"
    data-framework="laravel-12" data-template="laravel-12">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>@yield('title', 'Report App')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/site.css?v=pAGv4ietcJNk_EwsQZ5BN9-K4MuNYS2a9wl4Jw-q9D0') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fonts/boxicons.css?v=9TP2c72sCju5P-TflYeQvmcuT01tDBTeFrPe0E7TCTY') }}"
        rel="stylesheet">

    <link href="{{ asset('vendor/css/rtl/core.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/rtl/theme-default.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/pages/page-auth.css?v=At_2ncOU_jlMA7mMS1RmzRT-tTCP6KzMBMenp8yEmNs') }}"
        rel="stylesheet">

    @stack('styles')

    <script src="{{ asset('vendor/js/helpers.js') }}" defer></script>
    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('js/config.js') }}" defer></script>
</head>

<body>
    @yield('content')

    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}" defer></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}" defer></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    @stack('scripts')
</body>

</html>
