<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->

<head>
    <base href="{{route('home')}}">
    <meta charset="utf-8" />
    <title> @yield('page-header', 'Trang Quản Trị') - @yield('page-sub_header', 'DashBoard')</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{asset('')}}assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('style')

    <style>
        .swal2-popup .swal2-icon{
            margin: 10px auto !important;
        }

    </style>
    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />
    <link href="admin/css/style.css?v1" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ favicon('favicon.ico') }}" />

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/spruce@2.x.x/dist/spruce.umd.js" defer></script>

    @stack('css')

</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <!-- begin:: Page -->
    <!-- begin:: Header Mobile -->
    @include('elements.loading', ['loading_position' => 'absolute'])
    <input id="site-main" name="site-main" type="hidden" value="{{ Config::get('domain.web.domain') }}/" />
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="/">
                <img alt="Logo" src="assets/media/logos/logo-light.png" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left"
                id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                    class="flaticon-more"></i></button>
        </div>
    </div>
    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <!-- BEGIN: Left Aside -->
            @include('left-aside')
            <!-- END: Left Aside -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                <!-- begin:: Header -->
                @include('header')
                <!-- end:: Header -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                    <!-- begin:: Content -->
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                        <!-- begin:: Breadcrumb -->
                        @include('elements.breadcrumb')
                        <!-- end:: Breadcrumb -->
                        @yield('content')
                    </div>
                    <!-- end:: Content -->
                </div>
                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            2020&nbsp;&copy;&nbsp;<a href="#" target="_blank" class="kt-link">AppotaPay</a>
                        </div>

                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
        </div>
    </div>
    <!-- end:: Page -->
    <!-- end::Quick Panel -->
    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>
    <!-- begin::Global Config(global config for global JS sciprts) -->
    @livewireStyles

    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>

    <script>

    </script>
    {{-- end custom datetimepicker --}}

    <!-- end::Global Config -->
    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="assets/plugins/global/plugins.bundle.js?v=1.0" type="text/javascript" defer></script>
    <script src="assets/js/scripts.bundle.js?v=1.0" type="text/javascript" defer></script>
    <script src="admin/js/main.js?v={{time()}}" type="text/javascript" defer></script>
    <!--end::Global Theme Bundle -->
    <!--begin::Page Vendors(used by this page) -->
    @yield('vendor-script', '')
    <!--end::Page Vendors -->
    <!--begin::Page Scripts(used by this page) -->
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
    <script type="text/javascript" defer>
        window.__user__ = @json(auth()->user())
    </script>
    <script src="{{ mix('/js/app.js') }}?v={{ time() }}" defer></script>
    @yield('scriptsExtra')
    @livewireScripts
    @stack('scripts')
    <script src="{{asset('js/livewirejs.js')}}"></script>
    <script src="{{asset('js/livewirejs2.js')}}"></script>
    @yield('scriptlivewire')
    @stack('scriptsChart')
    <!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>
