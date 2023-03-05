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

<body class="sidebar-mini layout-fixed dark-mode">
{{--<body class="sidebar-mini layout-fixed">--}}
<div class="wrapper">

    @include('layouts/admin/_header')

    @include('layouts/admin/_sidebar')

    <div class="content-wrapper">
        @include('layouts/admin/_page-header')

        <section class="content">
            <div class="container-fluid">
                @include('layouts/admin/_alerts')
                @yield('content')
            </div>
        </section>
    </div>
</div>

</body>
</html>
