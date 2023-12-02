<!DOCTYPE html>
@php $dir = in_array(Auth::user()->type, ['admin', 'user_management']) ? 'ltr' : 'rtl'; @endphp

<html lang="en" dir="{{ $dir }}" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>
    <style>
        .page-link,
        .scrollToTop {
            background-color: #0695dd !important;
            /* background: linear-gradient(to right,rgb(var(--teal-rgb)) 0,#0695dd 100%)!important; */
        }
    </style>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- Favicon -->
    <link rel="icon" href="/storage/uploads/images/logoCompany.png" type="image/x-icon">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Rtl Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">
    {{-- <script src="../../../public/assets/js/jquery.js"></script> --}}
    {{-- Select2 --}}
    {{-- <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
</head>

<body>

    <!-- Start Switcher -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title text-default" id="offcanvasRightLabel">Switcher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="border-bottom border-block-end-dashed">
                <div class="nav nav-tabs nav-justified" id="switcher-main-tab" role="tablist">
                    <button class="nav-link active" id="switcher-home-tab" data-bs-toggle="tab"
                        data-bs-target="#switcher-home" type="button" role="tab" aria-controls="switcher-home"
                        aria-selected="true">Theme Styles</button>
                    <button class="nav-link" id="switcher-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#switcher-profile" type="button" role="tab"
                        aria-controls="switcher-profile" aria-selected="false">Theme Colors</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active border-0" id="switcher-home" role="tabpanel"
                    aria-labelledby="switcher-home-tab" tabindex="0">
                    <div class="">
                        <p class="switcher-style-head">Theme Color Mode:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-light-theme">
                                        Light
                                    </label>
                                    <input class="form-check-input" type="radio" name="theme-style"
                                        id="switcher-light-theme" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-dark-theme">
                                        Dark
                                    </label>
                                    <input class="form-check-input" type="radio" name="theme-style"
                                        id="switcher-dark-theme">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Directions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-ltr">
                                        LTR
                                    </label>
                                    <input class="form-check-input" type="radio" name="direction"
                                        id="switcher-ltr">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-rtl">
                                        RTL
                                    </label>
                                    <input class="form-check-input" type="radio" name="direction"
                                        id="switcher-rtl">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Navigation Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-vertical">
                                        Vertical
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-style"
                                        id="switcher-vertical" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-horizontal">
                                        Horizontal
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-style"
                                        id="switcher-horizontal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navigation-menu-styles">
                        <p class="switcher-style-head">Vertical & Horizontal Menu Styles:</p>
                        <div class="row switcher-style gx-0 pb-2 gy-2">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-click">
                                        Menu Click
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-menu-click">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-hover">
                                        Menu Hover
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-menu-hover">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-click">
                                        Icon Click
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-icon-click">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-hover">
                                        Icon Hover
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-icon-hover">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidemenu-layout-styles">
                        <p class="switcher-style-head">Sidemenu Layout Styles:</p>
                        <div class="row switcher-style gx-0 pb-2 gy-2">
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-default-menu">
                                        Default Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-default-menu" checked>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-closed-menu">
                                        Closed Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-closed-menu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icontext-menu">
                                        Icon Text
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-icontext-menu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-overlay">
                                        Icon Overlay
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-icon-overlay">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-detached">
                                        Detached
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-detached">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-double-menu">
                                        Double Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-double-menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Page Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-regular">
                                        Regular
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles"
                                        id="switcher-regular" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-classic">
                                        Classic
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles"
                                        id="switcher-classic">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-modern">
                                        Modern
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles"
                                        id="switcher-modern">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Layout Width Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-full-width">
                                        Full Width
                                    </label>
                                    <input class="form-check-input" type="radio" name="layout-width"
                                        id="switcher-full-width" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-boxed">
                                        Boxed
                                    </label>
                                    <input class="form-check-input" type="radio" name="layout-width"
                                        id="switcher-boxed">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Menu Positions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-fixed">
                                        Fixed
                                    </label>
                                    <input class="form-check-input" type="radio" name="menu-positions"
                                        id="switcher-menu-fixed" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-scroll">
                                        Scrollable
                                    </label>
                                    <input class="form-check-input" type="radio" name="menu-positions"
                                        id="switcher-menu-scroll">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Header Positions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-header-fixed">
                                        Fixed
                                    </label>
                                    <input class="form-check-input" type="radio" name="header-positions"
                                        id="switcher-header-fixed" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-header-scroll">
                                        Scrollable
                                    </label>
                                    <input class="form-check-input" type="radio" name="header-positions"
                                        id="switcher-header-scroll">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Loader:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-loader-enable">
                                        Enable
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-loader"
                                        id="switcher-loader-enable">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-loader-disable">
                                        Disable
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-loader"
                                        id="switcher-loader-disable" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade border-0" id="switcher-profile" role="tabpanel"
                    aria-labelledby="switcher-profile-tab" tabindex="0">
                    <div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Menu Colors:</p>
                            <div class="d-flex switcher-style pb-2">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Light Menu" type="radio" name="menu-colors"
                                        id="switcher-menu-light">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Dark Menu" type="radio" name="menu-colors"
                                        id="switcher-menu-dark" checked>
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Color Menu" type="radio" name="menu-colors"
                                        id="switcher-menu-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-gradient"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Gradient Menu"
                                        type="radio" name="menu-colors" id="switcher-menu-gradient">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-transparent"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Transparent Menu"
                                        type="radio" name="menu-colors" id="switcher-menu-transparent">
                                </div>
                            </div>
                            <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Menu dynamically
                                change from below Theme Primary color picker</div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Header Colors:</p>
                            <div class="d-flex switcher-style pb-2">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Light Header" type="radio"
                                        name="header-colors" id="switcher-header-light" checked>
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Dark Header" type="radio"
                                        name="header-colors" id="switcher-header-dark">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Color Header" type="radio"
                                        name="header-colors" id="switcher-header-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-gradient"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Gradient Header"
                                        type="radio" name="header-colors" id="switcher-header-gradient">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-transparent"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Transparent Header"
                                        type="radio" name="header-colors" id="switcher-header-transparent">
                                </div>
                            </div>
                            <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Header dynamically
                                change from below Theme Primary color picker</div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Theme Primary:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-1" type="radio"
                                        name="theme-primary" id="switcher-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-2" type="radio"
                                        name="theme-primary" id="switcher-primary1">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-3" type="radio"
                                        name="theme-primary" id="switcher-primary2">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-4" type="radio"
                                        name="theme-primary" id="switcher-primary3">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-5" type="radio"
                                        name="theme-primary" id="switcher-primary4">
                                </div>
                                <div class="form-check switch-select ps-0 mt-1 color-primary-light">
                                    <div class="theme-container-primary"></div>
                                    <div class="pickr-container-primary"></div>
                                </div>
                            </div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Theme Background:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-1" type="radio"
                                        name="theme-background" id="switcher-background">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-2" type="radio"
                                        name="theme-background" id="switcher-background1">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-3" type="radio"
                                        name="theme-background" id="switcher-background2">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-4" type="radio"
                                        name="theme-background" id="switcher-background3">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-5" type="radio"
                                        name="theme-background" id="switcher-background4">
                                </div>
                                <div
                                    class="form-check switch-select ps-0 mt-1 tooltip-static-demo color-bg-transparent">
                                    <div class="theme-container-background"></div>
                                    <div class="pickr-container-background"></div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-image mb-3">
                            <p class="switcher-style-head">Menu With Background Image:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img1" type="radio"
                                        name="theme-background" id="switcher-bg-img">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img2" type="radio"
                                        name="theme-background" id="switcher-bg-img1">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img3" type="radio"
                                        name="theme-background" id="switcher-bg-img2">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img4" type="radio"
                                        name="theme-background" id="switcher-bg-img3">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img5" type="radio"
                                        name="theme-background" id="switcher-bg-img4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid canvas-footer">
                    <a href="javascript:void(0);" id="reset-all" class="btn btn-danger m-1">Reset</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Switcher -->


    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('assets/images/media/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header pt-4 pb-5">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid ">

                <!-- Start::header-content-left -->
                <div class="header-content-left ">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="" class="header-logo">
                                <img src="/storage/uploads/images/logoCompany.png" alt="logo"
                                    class="desktop-logo">
                                <img src="/storage/uploads/images/logoCompany.png" alt="logo"
                                    class="toggle-logo">
                                <img src="/storage/uploads/images/logoCompany.png" alt="logo"
                                    class="desktop-dark">
                                <img src="/storage/uploads/images/logoCompany.png" alt="logo"
                                    class="toggle-dark">
                                <img src="/storage/uploads/images/logoCompany.png" alt="logo"
                                    class="desktop-white">
                                <img src="/storage/uploads/images/logoCompany.png" alt="logo"
                                    class="toggle-white">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                    <!-- Start::header-element -->
                    <div class="header-element header-theme-mode  ">
                        <!-- Start::header-link|layout-setting -->
                        <a href="javascript:void(0);" class="header-link layout-setting">
                            <span class="light-layout">
                                <!-- Start::header-link-icon -->
                                <i class="bx bx-moon header-link-icon"></i>
                                <!-- End::header-link-icon -->
                            </span>
                            <span class="dark-layout">
                                <!-- Start::header-link-icon -->
                                <i class="bx bx-sun header-link-icon"></i>
                                <!-- End::header-link-icon -->
                            </span>
                        </a>

                        <!-- End::header-link|layout-setting -->
                    </div>
                    <!-- End::header-element -->


                    <!-- Start::header-element -->
                    <div class="header-element notifications-dropdown0  ">
                        <!-- Start::header-link|dropdown-toggle -->
                        <x-news.notifications />

                        <!-- End::main-header-dropdown -->
                    </div>
                    <!-- End::header-element -->


                    <!-- Start::header-element -->
                    {{-- <div class="header-element header-fullscreen">
                        <!-- Start::header-link -->
                        <a onclick="openFullscreen();" href="#" class="header-link">
                            <i class="bx bx-fullscreen full-screen-open header-link-icon"></i>
                            <i class="bx bx-exit-fullscreen full-screen-close header-link-icon d-none"></i>
                        </a>
                        <!-- End::header-link -->
                    </div> --}}
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element ">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex flex-column align-items-center">
                                {{-- <div class="d-sm-block d-none">
                                    <p class="fw-semibold mb-0 lh-1"> {{ Auth::user()->name }}</p>
                                    <span class="op-7 fw-normal d-block fs-11">userName</span>

                                </div> --}}
                                <div class="me-sm-2 me-0 pb-2">
                                    @if (Auth::user()->image)
                                        <img src="/storage/{{ Auth::user()->image }}" width="65" height="65"
                                            class="rounded-circle" alt="img">
                                    @else
                                        <img src="{{ asset('assets/images/faces/13.jpg') }}" width="50"
                                            height="50" class="rounded-circle " alt="img">
                                    @endif
                                </div>

                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 mt-3 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            <li><a class="dropdown-item d-flex"
                                    href="{{ route('profile.edit', Auth::user()->id) }}"><i
                                        class="ti ti-user-circle fs-18 me-2 op-7"></i>
                                    Profile</a>
                            </li>

                            {{-- <li><a class="dropdown-item d-flex" href="mail.html"><i class="ti ti-inbox fs-18 me-2 op-7"></i>Inbox <span class="badge bg-success-transparent ms-auto">25</span></a></li> --}}
                            {{-- <li><a class="dropdown-item d-flex border-block-end" href="to-do-list.html"><i class="ti ti-clipboard-check fs-18 me-2 op-7"></i>Task Manager</a></li> --}}
                            {{-- <li><a class="dropdown-item d-flex" href="mail-settings.html"><i
                                        class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>Settings</a></li> --}}
                            {{-- <li><a class="dropdown-item d-flex border-block-end" href="javascript:void(0);"><i class="ti ti-wallet fs-18 me-2 op-7"></i>Bal: $7,12,950</a></li> --}}
                            {{-- <li><a class="dropdown-item d-flex" href="chat.html"><i class="ti ti-headset fs-18 me-2 op-7"></i>Support</a></li> --}}
                            <li><a class="dropdown-item d-flex" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="ti ti-logout fs-18 me-2 op-7"></i>Log Out</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    {{-- <div class="header-element">
                        <!-- Start::header-link|switcher-icon -->
                        <a href="#" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                            <i class="bx bx-cog header-link-icon"></i>
                        </a>
                        <!-- End::header-link|switcher-icon -->
                    </div> --}}
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header pt-5 pb-5">
                <a href="{{ route('/') }}" class="header-logo text-center ">
                    <img src="/storage/uploads/images/logoCompany.png" alt="Yas E System" width="75"
                        style="height: 100px;" class="desktop-logo pb-2">
                    {{-- <p class="mt-1 " style="color: #fff">Yas E System</p> --}}
                    <img src="/storage/uploads/images/logoCompany.png" alt="Yas E System" width="75"
                        style="height: 100px;" class="toggle-logo pb-2">
                    <img src="/storage/uploads/images/logoCompany.png" alt="Yas E System" width="75"
                        style="height: 80px;" class="desktop-dark pb-2">
                    <img src="/storage/uploads/images/logoCompany.png" alt="Yas E System" width="75"
                        style="height: 100px;" class="toggle-dark pb-2">
                    <img src="/storage/uploads/images/logoCompany.png" alt="Yas E System" width="75"
                        style="height: 100px;" class="desktop-white pb-2">
                    <img src="/storage/uploads/images/logoCompany.png" alt="Yas E System" width="75"
                        style="height: 100px;" class="toggle-white pb-2">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar pt-5" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open ">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    {{-- <ul class="main-menu">
                        <!-- Start::slide -->
                        <li class="slide ">
                            <a href="{{ route('/') }}" class="side-menu__item fs-5">
                                <i class="bi bi-house-door-fill"></i>
                                <span class="side-menu__label"> Home Page </span>
                            </a>
                        </li>
                        @if (in_array(Auth::user()->type, ['admin', 'user_management']))
                            <li class="slide ">
                                <a href="{{ route('users.index') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-person-check"></i>
                                    <span class="side-menu__label"> All Users as active </span>
                                    <i class="fe fe-chevron-right side-menu__angle ms-5"></i>
                                </a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="blog.html" class="side-menu__item">Blog</a>
                                    </li>
                                    <li class="slide">
                                        <a href="blog-details.html" class="side-menu__item">Blog Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="blog-create.html" class="side-menu__item">Create Blog</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide ">
                                <a href="{{ route('users.trashed') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-person-dash"></i>
                                    <span class="side-menu__label">All Users as inactive </span>
                                </a>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide ">
                                <a href="{{ route('users.create') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-person-plus-fill"></i>
                                    <span class="side-menu__label"> Add New User </span>
                                </a>
                            </li>
                            <li class="slide ">
                                <a href="{{ route('tiles.index') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-window"></i>
                                    <span class="side-menu__label"> All Tiles as active </span>
                                </a>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide ">
                                <a href="{{ route('tiles.trashed') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-window-dash"></i>
                                    <span class="side-menu__label"> All Tiles as inactive </span>
                                </a>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide ">
                                <a href="" class="side-menu__item fs-5" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-bs-whatever="@mdo">
                                    <i class="bi bi-window-plus"></i>
                                    <span class="side-menu__label"> Add New Tiles </span>
                                </a>
                            </li>
                            <!-- End::slide -->
                        @endif
                    </ul> --}}
                    <ul class="main-menu">
                        @if (Auth::user()->type == 'user')
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item fs-5">
                                    {{-- <i class="bi bi-file-person-fill"></i> --}}
                                    <span class="side-menu__label ms-2">Menu</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide ">
                                        <a href="{{ route('/') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-house-door-fill"></i>
                                            <span class="side-menu__label ms-2"> Home Page </span>
                                        </a>
                                    </li>
                                    <li class="slide ">
                                        <a href="{{ route('links.usrsAcc') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-people-fill"></i>
                                            <span class="side-menu__label ms-2"> Users acc</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('news.getnews') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-newspaper"></i>
                                            <span class="side-menu__label ms-2"> All News </span>
                                        </a>
                                    </li>
                                    <li class="slide ">
                                        <a href="{{ route('users.getrecoverycode', Auth::id()) }}"
                                            class="side-menu__item fs-5">
                                            <i class="bi bi-key"></i>
                                            <span class="side-menu__label ms-2">Recovery Code</span>
                                        </a>
                                    </li>
                                    <li class="slide ">
                                        <a href="{{ route('addlinks') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-link"></i>
                                            <span class="side-menu__label ms-2"> Add acc</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Start::slide__HomePage -->
                            <div class="news">
                                <div class="d-flex flex-column" dir="ltr">
                                    @foreach ($lastnews as $post)
                                        <div class=" mt-2 mb-2 container">
                                            {{-- color: #fff; --}}
                                            <div class="text p-2 border border-info me-auto bg-light "
                                                style=" height: 200px; overflow: scroll; ">
                                                {!! $post->news !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        @endif


                        <!-- End::slide__category -->
                        @if (in_array(Auth::user()->type, ['admin', 'user_management']))
                            <li class="slide ">
                                <a href="{{ route('/') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-house-door-fill"></i>
                                    <span class="side-menu__label ms-2"> Home Page </span>
                                </a>
                            </li>
                            <li class="slide ">
                                <a href="{{ route('links.usrsAcc') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-people-fill"></i>
                                    <span class="side-menu__label ms-2"> Users acc</span>
                                </a>
                            </li>
                            <li class="slide ">
                                <a href="{{ route('addlinks') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-link"></i>
                                    <span class="side-menu__label ms-2"> Add acc</span>
                                </a>
                            </li>
                            <li class="slide ">
                                <a href="{{ route('logfiles.index') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-shield-lock-fill"></i>
                                    <span class="side-menu__label ms-2">Logfiles</span>
                                </a>
                            </li>
                            <li class="slide ">
                                <a href="{{ route('users.getrecoverycode', Auth::id()) }}"
                                    class="side-menu__item fs-5">
                                    <i class="bi bi-key"></i>
                                    <span class="side-menu__label ms-2">Recovery Code</span>
                                </a>
                            </li>
                            {{-- <li class="slide ">
                                <a href="{{ route('2fa') }}" class="side-menu__item fs-5">
                                    <i class="bi bi-key"></i>
                                    <span class="side-menu__label ms-2">Enable 2FA</span>
                                </a>
                            </li> --}}
                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item fs-5">
                                    <i class="bi bi-file-person-fill"></i>
                                    <span class="side-menu__label ms-2">Users</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide">
                                        <a id="all-users" href="{{ route('users.index') }}"
                                            class="side-menu__item fs-5">
                                            <i class="bi bi-person-check"></i>
                                            <span class="side-menu__label ms-2"> All Users </span>
                                        </a>
                                    </li>
                                    {{-- <li class="slide">
                                        <a href="{{ route('users.trashed') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-person-dash"></i>
                                            <span class="side-menu__label ms-2">All Users as inactive </span>
                                        </a>
                                    </li> --}}
                                    <li class="slide">
                                        <a href="{{ route('users.create') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-person-plus-fill"></i>
                                            <span class="side-menu__label ms-2"> Add New User </span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item fs-5">
                                    <i class="bi bi-window"></i>
                                    <span class="side-menu__label ms-2">Tiles</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1" style="list-style-type: none;">
                                    <li class="slide">
                                        <a href="{{ route('tiles.index') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-window"></i>
                                            <span class="side-menu__label ms-2"> All Tiles </span>
                                        </a>
                                    </li>
                                    {{-- <li class="slide">
                                        <a href="{{ route('tiles.trashed') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-window-dash"></i>
                                            <span class="side-menu__label ms-2"> All Tiles as inactive </span>
                                        </a>
                                    </li> --}}
                                    <li class="slide">
                                        <a href="" class="side-menu__item fs-5" data-bs-toggle="modal"
                                            data-bs-target="#addtiles" data-bs-whatever="@mdo">
                                            <i class="bi bi-window-plus"></i>
                                            <span class="side-menu__label ms-2"> Add New Tiles </span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item fs-5">
                                    <i class="bi bi-newspaper"></i>
                                    <span class="side-menu__label ms-2">NEWS</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1" style="list-style-type: none;">
                                    <li class="slide">
                                        <a href="{{ route('news.getnews') }}" class="side-menu__item fs-5">
                                            <i class="bi bi-newspaper"></i>
                                            <span class="side-menu__label ms-2"> All News </span>
                                        </a>
                                    </li>
                                    @if (in_array(Auth::user()->type, ['admin', 'user_management']))
                                        <li class="slide">
                                            <a href="" class="side-menu__item fs-5" data-bs-toggle="modal"
                                                data-bs-target="#addnews" data-bs-whatever="@mdo">
                                                <i class="bi bi-window-plus"></i>
                                                <span class="side-menu__label ms-2"> Add News </span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                            <!-- End::slide -->

                        @endif
                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid mt-5" dir="ltr">
                @yield('content')
            </div>
        </div>
        <!-- End::app-content -->
        @if (in_array(Auth::user()->type, ['admin', 'user_management']))
            {{-- Start Modal for add tiles --}}
            <div class="modal fade" id="addtiles" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1> --}}
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        {{-- @if (session()->has('success'))
                                <div id="success-message" class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif --}}
                        <div id="js-success-message" class="alert alert-success d-none"></div>

                        <div class="modal-body">
                            <h3 class="text-center pb-1">Add New Of Tiles</h3>

                            <form id="add-tile-form" action="{{ route('tiles.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form  border bg-blue-transparent p-3">
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label fs-14 text-dark"> Name Of
                                            Tiles</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Name Of Tiles">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="color" class="form-label fs-14 text-dark"> Color Of
                                            Tiles</label>
                                        <input type="color" class="form-control" name="color" id="color">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="formFile" class="form-label">Logo</label>
                                        <input class="form-control @error('logo') is-invalid @enderror" name="logo"
                                            type="file" id="formFile">
                                        @error('logo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="link" class="form-label fs-14 text-dark"> Url Of
                                            Tiles</label>
                                        <input type="url" class="form-control" name="link" id="link">
                                    </div>
                                    <button class="btn btn-secondary mb-2" type="submit">Add</button>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Close</button>
                            {{-- <button type="button" class="btn btn-info">Send message</button> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal for add tiles --}}

            {{-- Start Modal for Add news --}}
            <div class="modal fade" id="addnews" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        {{-- <div id="js-success-message" class="alert alert-success d-none">
                </div> --}}

                        <div class="modal-body">

                            <h3 class="text-center pb-1">Add NEWS
                            </h3>

                            {{-- <form id="add-tile-form" action="" method="POST"
                                enctype="multipart/form-data">
                                @csrf --}}
                            <div class="container text-center" dir="ltr" lang="en">
                                <div class="row">
                                    <div class="col-12  mt-4">
                                        <div class="card-body">
                                            <div id="success-message d-none"></div>
                                            <form id="add-news-form">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea class="ckeditor form-control" name="news" id="news-text-input"></textarea>
                                                </div>

                                                <button type="button" id="post-news-button"
                                                    class="btn btn-info mt-3">Post</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- </form> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Close</button>
                            {{-- <button type="button" class="btn btn-info">Send message</button> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal for Add news --}}
            <!-- Footer Start -->
        @endif
        {{-- <div id="crm-total-customers"></div> --}}
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted"> Copyright © <span id="year">ok</span> <a href="https://yasesys.com/"
                        target="_blank" class="text-muted">YAS Electronic Systems</a>
                    All
                    rights
                    reserved
                </span>
            </div>
        </footer>
        <!-- Footer End -->

    </div>


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    {{-- <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script> --}}

    <!-- Scroll To Top -->
    {{-- <script src="../../../public/assets/js/jquery.js"></script> --}}
    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>



    <!-- JSVector Maps JS -->
    {{-- <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script> --}}

    <!-- JSVector Maps MapsJS -->
    {{-- <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script> --}}

    <!-- Apex Charts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Chartjs Chart JS -->
    <script src="{{ asset('assets/libs/chart.js/chart.min.js') }}"></script>

    <!-- CRM-Dashboard -->
    <script src="{{ asset('assets/js/crm-dashboard.js') }}"></script>


    <!-- Custom-Switcher JS -->
    <script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>
    <!-- Mail Settings -->
    <script src="{{ asset('assets/js/mail-settings.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/select2.min.js') }}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#post-news-button').click(function() {
                // alert('TESTER ')
                // var newsText = $("#news-text-input").val();
                var editor = CKEDITOR.instances['news-text-input'];
                var newsText = editor.getData();
                var formData = new FormData();
                formData.append('news', newsText);
                console.log('News Text:', newsText);
                $.ajax({
                    method: 'POST',
                    url: '{{ route('news.store') }}',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(data) {
                        // Extract the success message from the JSON response
                        var successMessage = data.success;
                        console.log(successMessage)
                        // Display the success message in the form
                        $('#success-message').removeClass('d-none').text(successMessage);

                        editor.setData('');
                        setTimeout(function() {

                            $('success-message').addClass('d-none').text('');
                        }, 3000);
                    },

                    error: function(data) {
                        // Handle errors here
                        console.log(data);
                    }


                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#post-news-button').click(function() {
                // var newsText = $("#news-text-input").val();
                var editor = CKEDITOR.instances['news-text-input'];
                var newsText = editor.getData();
                var formData = new FormData();
                formData.append('news', newsText);
                console.log('News Text:', newsText);
                $.ajax({
                    method: 'POST',
                    url: '{{ route('news.store') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // Extract the success message from the JSON response
                        var successMessage = data.success;
                        console.log(successMessage)
                        // Display the success message in the form
                        $('#success-message').removeClass('d-none').text('successMessage');
                        alert('TESTER ')
                        editor.setData('');
                        setTimeout(function() {

                            $('success-message').addClass('d-none').text('');
                        }, 3000);
                    },

                    error: function(data) {
                        // Handle errors here
                        console.log(data);
                    }


                });
            });
        });
    </script>
    {{-- // to hidden flash message after 5 seconed --}}
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    </script>
    {{-- To Display password --}}
    <script>
        $(document).ready(function() {
            $("#showPassword").click(function() {
                togglePasswordVisibility("password");
            });

            $("#showConfirmPassword").click(function() {
                togglePasswordVisibility("confirmPassword");
            });

            function togglePasswordVisibility(inputId) {
                var input = $("#" + inputId);
                var inputType = input.attr("type");

                if (inputType === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            }
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            // Handle form submission
            $('#add-tile-button').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tiles.store') }}",
                    data: new FormData($('#add-tile-form')[0]), // Serialize the form data
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            // Close the modal (if you're using one)
                            // $('#exampleModal').modal('hide');
                            // You can perform other actions here, e.g., update UI
                            // alert('Tile added successfully!');
                            var successMessage = data.message;
                            $('#js-success-message').removeClass('d-none').text(successMessage);
                            $('#add-tile-form')[0].reset();
                            setTimeout(function() {
                                $('#js-success-message').addClass('d-none').text('');
                            }, 3000);
                        } else {
                            // Handle validation errors or other errors
                            alert('Error: ' + data.message);
                        }
                    },
                    // error: function (xhr, status, error) {
                    //     // Handle AJAX request errors
                    //     console.error(xhr.responseText);
                    // }
                });
            });
        });
    </script> --}}
    <script>
        var hid = document.getElementsByClassName("pcr-app");
        // var hide = document.getElementById("SvgjsSvg1062");
        // var hide1 = document.getElementById("apexchartszckuzx0jj");
        // var elements = document.getElementsByName("svg");
        // hide.style.display= "none";
        // hide1.style.display= "none";
        // elements.style.display= "none";
        for (var i = 0; i < hid.length; i++) {
            hid[i].style.display = "none";
        }
    </script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            // Handle click event for the "Select All" checkbox
            // $('#selectAll').click(function() {
            //     // Check or uncheck all other checkboxes based on the "Select All" checkbox state
            //     $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
            // });
        });
    </script>
    <script>
        $('#mySelect2').select2({
            dropdownParent: $('#adduser')
        });
    </script>


</body>

</html>
