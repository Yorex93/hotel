@extends('layouts.app')

@section('styles')
    <style>
        .section__header{
            height: 300px
        }
    </style>
@endsection

@section('content')
<section class="section__header" id="section__header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="welcome__content">
                    <h1 class="welcome_content__title">Our rooms</h1>

                    <!-- Breadcrumbs -->
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Rooms</li>
                    </ol>

                    <p class="welcome_content__desc">Select from our array of well furnished hotel rooms</p>
                </div> <!-- .welcome__content -->
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
    <div class="home__bg rooms__bg" style="background-image: url({{ asset('assets/img/rooms_bg.jpg') }})"></div>
</section> <!-- / .section__header -->

<!-- section rooms-1 -->
<section class="section__rooms-1">
    <div class="container">
        <div class="row">
            @foreach($roomTypes AS $room)
                <div class="rooms__item">
                <div class="col-md-6">
                    <div class="rooms__pic">
                        <img src="{{ count($room->media) > 0 ? asset('storage/'.$room->media[0]->file) : '' }}" class="img-responsive" alt="...">
                    </div> <!-- / .about__pic -->
                </div>
                <div class="col-md-6">
                    <div class="rooms__desc">
                        <div class="rooms_desc__header">
                            <h2 class="rooms_desc__title">{{ $room->title }}</h2>
                            <p class="rooms_desc__price"><span>&#8358;{{ number_format($room->base_price_per_night, 2) }}</span> / night</p>
                        </div> <!-- .rooms_desc__header -->
                        <p class="rooms_desc__desc">
                            {{ $room->short_description }}
                        </p>
                        <div class="col-sm-6">
                            <ul class="rooms_desc__services">
                                <li><i class="icon ion-android-person"></i> One king bed</li>
                                <li><i class="icon ion-coffee"></i> Breakfast</li>
                                <li><i class="icon ion-android-sunny"></i> Air conditioning</li>
                            </ul> <!-- .rooms_desc__services -->
                        </div>
                        <div class="col-sm-6">
                            <ul class="rooms_desc__services">
                                <li><i class="icon ion-wineglass"></i> Mini bar</li>
                                <li><i class="icon ion-monitor"></i> LCD TV</li>
                                <li><i class="icon ion-wifi"></i> Wi-Fi</li>
                            </ul> <!-- .rooms_desc__services -->
                        </div>
                        <a href="{{ route('rooms.show', ['slug' => $room->slug]) }}" class="btn btn-rooms">View details</a>
                    </div> <!-- / .rooms__desc -->
                </div>
            </div> <!-- .rooms__item -->
            @endforeach
        </div> <!-- .row -->
    </div> <!-- / .container -->
</section>

@endsection

@section('scripts')

@endsection