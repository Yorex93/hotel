@extends('layouts.app')

@section('styles')
    <style>
        .welcome_content__title{
          font-size: 40px !important;
        }
    </style>
    <!-- Core CSS file -->
    <link rel="stylesheet" href="{{ asset('js/photoswipe/dist/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('js/photoswipe/dist/default-skin/default-skin.css') }}">
    <!-- Core JS file -->
    <script src="{{ asset('js/photoswipe/dist/photoswipe.min.js') }}"></script>
    <!-- UI JS file -->
    <script src="{{ asset('js/photoswipe/dist/photoswipe-ui-default.min.js') }}"></script>
@endsection

@section('content')
    <section class="section__header" id="section__header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="welcome__content">
                        <h1 class="welcome_content__title">{{ $hotelService->title }}</h1>

                        <!-- Breadcrumbs -->
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active">{{ $hotelService->title }}</li>
                        </ol>
                    </div> <!-- .welcome__content -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="home__bg rooms__bg" style="background-image: url({{ asset('images/hotel-service.jpg')}})"></div>
    </section> <!-- / .section__header -->

    <section class="section__room-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="room_detail__body">
                         <!-- .room-detail__gallery -->
                        <div class="room_price__body">
                            <h2 class="room__name">{{ $hotelService->title }}</h2>
                        </div>
                        <div class="room__desc">
                            {!! $hotelService->short_description !!}
                        </div>

                        <div class="room__desc">
                            {!! $hotelService->long_description !!}
                        </div>
                    </div> <!-- .room-detail__body -->
                    <div class="services_media">

                    </div> <!-- .room__reviews -->
                </div>

            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section> <!-- / .section reservation -->

@endsection

@section('scripts')

@endsection