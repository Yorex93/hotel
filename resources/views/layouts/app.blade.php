<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Located in the heart of Asaba, Delta State Nigeria, we offer our exclusive quality and affordable hotel and rooms for business and leisure activities">

    <title>{{ env('HOTEL_NAME', 'Hotel Valerie') }}{{ isset($pageTitle) ? ' | '.$pageTitle : '' }}</title>

    <link href="{{ asset('assets/plugins/lightbox/dist/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">

    <style>
        .btn-reservation-top{
            padding: 3px 15px;
        }

        .navbar-brand > img {
            height: 80px;
        }

        .footer__item img{
            height: 120px;
            display: block;
            margin: 0 auto;
        }

        .section__header {
            height: calc(50vh - 135px);
        }

        .booking__section{
            padding: 40px 0;
            background: #374853
        }

        .form-label{
            margin-bottom: 10px;
            color: #9E9E9E;
        }

        .vdp-datepicker input, .booking-check-form select{
            width: 100%;
            height: 50px;
            padding: 10px;
            background: transparent;
            color: #FFFFFF;
            border: 2px solid #FFFFFF;
            margin-bottom: 10px;
            outline: none;
        }

        .booking__stage{
            padding: 40px 0;
            position: relative;
        }

        div.loading{
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            justify-content: center;
            background: rgba(255,255,255,0.9);
        }

        div.loading svg{
            height: 100px;
            width: auto;
        }

        .welcome_content__title{
            font-size: 40px !important;
        }

        .service-image{
            width: auto;
            height: 200px;
        }

        @media screen and (max-width: 767px){
            .welcome_content__title{
                font-size: 24px !important;
            }
        }

        .room {
            display: flex;
            padding: 10px;
            border: 1px solid lightgray;
            transition: 0.3s all;
            cursor: pointer;
        }

        .room:hover {
            box-shadow: 3px 4px 20px 0px #ddd;
        }

        .room-block {
            display:  flex;
        }

        .room-img {
            flex: 1;
        }

        .room-img img{
            width: 100%;
        }

        .room-details {
            flex: 1;
            padding-left: 20px
        }

        .room-details h2 {
            margin: 0;
        }

        .room-details h3 {
            margin: 0;
        }

        table.room-selection{
            margin: 20px;
            width: 100%;
            border-color: lightgray;
        }

        table.room-selection td{
            padding: 0 20px
        }

        .confirm-booking > div{
            margin-bottom : 20px
        }

        .confirm-booking .heading {
            font-weight: bold;
        }

        .confirm-booking .value {
            font-size: 16px
        }

        .confirm-booking .value.amount{
            font-size: 20px;
            color: green;
            font-weight: bold;
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

    <script src="https://unpkg.com/vue"></script>
    {{--<script src="https://unpkg.com/vue@2.5.17/dist/vue.min.js"></script>--}}
    <script src="https://unpkg.com/vuejs-datepicker"></script>
    <script src="{{ asset('js/moment.js') }}"></script>

    @yield('scripts')
</body>
</html>
