@extends('layouts.app')

@section('styles')
    <style>

    </style>
@endsection

@section('content')
    <section class="section__header" id="section__header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="welcome__content">
                        <h1 class="welcome_content__title">{{ $facility->name }}</h1>

                        <!-- Breadcrumbs -->
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active">Facilities</li>
                        </ol>
                    </div> <!-- .welcome__content -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="home__bg rooms__bg" style="background-image: url({{ asset('images/hotel-service.jpg')}})"></div>
    </section> <!-- / .section__header -->
    
    <section class="section__gallery-alt">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="subheading">{{ $facility->name }}</h2>
                    <div class="divider">
                        <hr class="line1">
                        <hr class="line2">
                        <hr class="line1">
                    </div> <!-- / .divider -->
                    <p class="section__subtitle">
                        {{ $facility->short_description }}
                    </p>
                    <p class="section__subtitle">
                        {{ $facility->decription }}
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="gallery__items" class="row">
                @foreach($facility->media AS $media)
                    <div class="col-xs-12 col-sm-6 col-md-4 gallery__item all double-room">
                        <a href="{{ asset('storage/'.$media->file) }}" data-lightbox="gallery" data-title="{{ $facility->name }}">
                            <img src="{{ asset('storage/'.$media->file) }}" class="img-responsive" alt="...">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
@endsection