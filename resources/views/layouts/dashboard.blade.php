<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-skin="default"
    data-assets-path="{{ asset('') }}" data-template="vertical-menu-template" data-bs-theme="light"
    data-framework="laravel-12" data-template="laravel-12">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
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

    {{-- <link href="{{ asset('vendor/css/core.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('vendor/css/rtl/core.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('vendor/css/rtl/theme-default.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">
    <link
        href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css?v=8x4wwYA_YNgyCvPG8__4CsAA-qF9BDnxzdjrPY1U7OM') }}"
        rel="stylesheet">

    <link href="{{ asset('vendor/libs/apex-charts/apex-charts.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/select2/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/sweetalert2/sweetalert2.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/bootstrap-select/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/pages/page-auth.css?v=At_2ncOU_jlMA7mMS1RmzRT-tTCP6KzMBMenp8yEmNs') }}"
        rel="stylesheet">
    <link href="{{ asset('vendor/css/buttons.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/flatpickr.min.css') }}" rel="stylesheet">



    {{-- <link href="{{ asset('vendor/fonts/fontawesome.css') }}" rel="stylesheet"> --}}

    @stack('styles')


    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/forms-selects.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar  ">
        @include('components.sidemenu')

        <div class="layout-container">
            <div class="layout-page">
                @include('components.navbar')

                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y">

                        @yield('content')

                    </div>

                    {{-- @include('components.footer') --}}

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <div class="drag-target"></div>

    </div>

    {{-- <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('js/forms-selects.js') }}"></script>
    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('vendor/js/flatpickr.js') }}"></script>
    {{-- <script src="{{ asset('vendor/js/buttons.dataTables.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/js/datatables.buttons.js') }}"></script>
    <script src="{{ asset('vendor/js/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/js/buttons.html5.min.js') }}"></script> --}}

    <!-- Buttons extension -->
    <script src="{{ asset('vendor/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/js/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/js/buttons.html5.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script> --}}

    @stack('scripts')
    @yield('scripts')
</body>

</html>
