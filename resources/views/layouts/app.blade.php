<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/ico/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">

    <title>{{ config('app.name', 'Hotel') }}{{ isset($pageTitle) ? '| '.$pageTitle : '' }}</title>

    <link href="{{ asset('assets/plugins/lightbox/dist/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

    <style>
        .btn-reservation-top{
            padding: 3px 15px;
        }
    </style>

    @yield('styles')

</head>
<body id="index__page">
    <a id="back-to-top" href="#section__home" class="btn btn-top back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left">
        <i class="ion-android-arrow-up"></i>
    </a>
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>

    @include('layouts.partials._header')

    @include('layouts.partials._nav')

    <div class="content">
        @yield('content')
    </div>

    @include('layouts.partials._footer')

    <!-- JS Global -->
    <script src="{{ asset('assets/plugins/jquery/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    
    <!-- JS Plugins -->
    <script src="{{ asset('assets/plugins/moment-develop/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/lightbox/dist/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/owl-carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/contact/contact.js') }}"></script>
    
    <!-- JS Custom -->
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/google_maps.js') }}"></script>

    @yield('scripts')
</body>
</html>
