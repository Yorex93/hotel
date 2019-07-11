@extends('layouts.app')

@section('styles')
    <style>
        .about__desc p{
            line-height: 1.8;
        }
    </style>
@endsection


@section('content')
    <section class="section__header" id="section__header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="welcome__content">

                        <h2 class="welcome_content__title">About us</h2>

                        <!-- Breadcrumbs -->
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active">About us</li>
                        </ol>

                        <p class="welcome_content__desc">The Ideal home</p>

                    </div> <!-- .welcome__content -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="home__bg about__bg" style="background: url({{ asset('images/about-banner.jpeg') }});"></div>
    </section> <!-- / .section__header -->

    <section class="section__about" id="section__about">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section__title">
                        {!! collect($pageItems)->firstWhere('for', 'about.main')['heading'] !!}
                    </h2>
                    <div class="divider">
                        <hr class="line1">
                        <hr class="line2">
                        <hr class="line1">
                    </div> <!-- / .divider -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="container-fluid">
            <div class="row">
                <div class="section_about__content">
                    <div class="col-md-6">
                        <div class="about__pic">
                            <img src="{{ asset('images/home-image-1.jpeg') }}" class="img-responsive" alt="...">
                        </div> <!-- / .about__pic -->
                    </div>
                    <div class="col-md-6">
                        <div class="about__desc">
                            {!! collect($pageItems)->firstWhere('for', 'about.main')['content'] !!}
                        </div> <!-- / .about__desc -->
                    </div>
                </div> <!-- / .section_about__content -->
            </div> <!-- / .row -->
        </div>
    </section> <!-- / .section__about -->

    <section class="section__gallery">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section__title">Our <strong>Gallery</strong></h2>
                    <div class="divider">
                        <hr class="line1">
                        <hr class="line2">
                        <hr class="line1">
                    </div> <!-- / .divider -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div id="gallery__carousel" class="owl-carousel owl-theme gallery__body">
                        @foreach($hotels[0]->media AS $media)
                            <div class="gallery__item">
                                <a href="{{ asset('storage/'.$media->file) }}" data-lightbox="gallery" data-title="">
                                    <img src="{{ asset('storage/'.$media->file) }}" class="img-responsive" alt="...">
                                </a>
                            </div> <!-- .gallery__item -->
                    @endforeach
                    <!-- .gallery__item -->
                    </div> <!-- .gallery__body -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section> <!-- / .section__gallery -->

@endsection


@section('scripts')

@endsection