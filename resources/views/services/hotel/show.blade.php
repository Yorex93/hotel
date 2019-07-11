@extends('layouts.app')

@section('styles')
    <style>
        .welcome_content__title{
          font-size: 40px !important;
        }

        .service-image{
            width: auto;
            height: 200px;
        }
    </style>
    <!-- Core CSS file -->
    <link rel="stylesheet" href="{{ asset('js/magnific/magnific-popup.css') }}">
    <!-- Core JS file -->
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

    @if($hotelService->parent != null)
        <section class="section__gallery-alt">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="subheading">{{ $hotelService->title }}</h2>
                    <div class="divider">
                        <hr class="line1">
                        <hr class="line2">
                        <hr class="line1">
                    </div> <!-- / .divider -->
                    <p class="section__subtitle">
                        {{ $hotelService->short_description }}
                    </p>
                    <p class="section__subtitle">
                        {{ $hotelService->long_decription }}
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="gallery__items" class="row">
                @foreach($hotelService->media AS $media)
                    <div class="col-xs-12 col-sm-6 col-md-4 gallery__item all double-room">
                        <a href="{{ asset('storage/'.$media->file) }}" data-lightbox="gallery" data-title="{{ $hotelService->title }}">
                            <img src="{{ asset('storage/'.$media->file) }}" class="img-responsive" alt="...">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @else
        @if(count($hotelService->children) > 0)
            <section class="section__rooms-2">
                <div class="container">
                    <div class="row">
                        @foreach($hotelService->children AS $childService)
                        <div class="col-md-4 col-sm-6">
                            <div class="rooms__item">
                                @if(count($childService->media))
                                <div class="rooms__pic">
                                    <img src="{{ asset('storage/'.$childService->media[0]->file) }}" class="img-responsive" alt="..." style="width: 100%">
                                </div> <!-- / .about__pic -->
                                @endif
                                <div class="rooms__desc">
                                    <div class="rooms_desc__header">
                                        <h2 class="rooms_desc__title">{{ $childService->title }}</h2>
                                    </div> <!-- .rooms_desc__header -->
                                    <p class="rooms_desc__desc">
                                        {{ str_limit($childService->short_description, 150, '...') }}
                                    </p>
                                    <a href="{{ route('hotel-services.show', ['slug' => $childService->slug]) }}" class="btn btn-rooms">More details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div> <!-- .row -->
                </div> <!-- / .container -->
            </section>
        @endif
    @endif





@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
@endsection