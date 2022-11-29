<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App name -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="libraries\assets\images\favicon.ico" type="image/x-icon">

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,600,800" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>

{{--@include('layouts/admin/_preloader')--}}

<div id="pcoded" class="pcoded iscollapsed" nav-type="st6" theme-layout="vertical" vertical-placement="left" vertical-layout="wide" pcoded-device-type="desktop" vertical-nav-type="expanded" vertical-effect="shrink" vnavigation-view="view1" fream-type="theme1" sidebar-img="false" sidebar-img-type="img1" layout-type="light">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @include('layouts/admin/_header')

        <div class="pcoded-main-container" style="margin-top: 56px!important;">
            <div class="pcoded-wrapper">

                @include('layouts/admin/_sidebar')

                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <div class="main-body">
                            <div class="page-wrapper">

                                @include('layouts/admin/_page-header')

                                @include('layouts/admin/_alerts')

                                <div class="page-body">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="/libraries/bower_components/jquery/js/jquery.min.js"></script>
<script src="/libraries/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script src="/libraries/bower_components/popper.js/js/popper.min.js"></script>
<script src="/libraries/bower_components/bootstrap/js/bootstrap.min.js"></script>
<script src="/libraries/assets/js/pcoded.min.js"></script>
<script src="/libraries/assets/js/vartical-layout.min.js"></script>
<script src="/libraries/assets/js/script.js"></script>
</body>

</html>
