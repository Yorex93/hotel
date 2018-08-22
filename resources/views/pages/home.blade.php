@extends('layouts.app')

@section('styles')
<style>
    .carousel .carousel-inner .item.no-tint:before{
        background-color: rgba(0,0,0,0.1);
    }

    .testimonials__img img{
        height: 120px;
    }

    .about__desc p {
        line-height: 1.8em;
    }

    .about__desc h3 {
        font-size: 30px;
    }
</style>
@endsection




@section('content')

    @php

        $welcomeContent = collect($pageItems)->firstWhere('for', 'home.welcome');
        $roomContent = collect($pageItems)->firstWhere('for', 'home.rooms');
        $galleryContent = collect($pageItems)->firstWhere('for', 'home.gallery');
        $testimonialContent = collect($pageItems)->firstWhere('for', 'home.testimonials');


    @endphp

    <!-- CONTENT
  ================================================== -->

    <!-- section home -->
    <section class="section__home"  id="section__home">

        <!-- CAROUSEL
        ================================================== -->
        <div id="carousel-example-generic" class="carousel carousel-fade slide" data-ride="carousel">

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <div class="item item__1 no-tint active" style="background: url('{{ asset('images/room-banner.jpeg') }}') no-repeat center center / cover;">
                    <div class="item__container">
                        <div class="item-container__inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="item__content">
                                            <h1 class="item_content__title">The Ideal <span>Home</span></h1>
                                            <div class="divider">
                                                <hr class="line1">
                                                <hr class="line2">
                                                <hr class="line1">
                                            </div> <!-- / .divider -->
                                            <p class="item_content__desc">Experience a quiet and relaxing atmosphere</p>
                                            <a href="#section__about" class="btn btn-reservation">Explore it</a>
                                        </div> <!-- .slide__content -->
                                    </div>
                                </div> <!-- / .row -->
                            </div> <!-- / .container -->
                        </div> <!-- / .item-container__inner -->
                    </div> <!-- / .item__container -->
                </div> <!-- / .item -->

                <div class="item no-tint item__2" style="background: url('{{ asset('images/dinner-banner.jpeg') }}') no-repeat center center / cover;">
                    <div class="item__container">
                        <div class="item-container__inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="item__content">
                                            <h1 class="item_content__title">Best <span>Cousine</span></h1>
                                            <div class="divider">
                                                <hr class="line1">
                                                <hr class="line2">
                                                <hr class="line1">
                                            </div> <!-- / .divider -->
                                            <p class="item_content__desc">Enjoy our best meals</p>
                                            <a href="#" class="btn btn-reservation">Discover meals</a>
                                        </div> <!-- .slide__content -->
                                    </div>
                                </div> <!-- / .row -->
                            </div> <!-- / .container -->
                        </div> <!-- / .item-container__inner -->
                    </div> <!-- / .item__container -->
                </div> <!-- / .item -->

                <div class="item item__3 no-tint" style="background: url('{{ asset('images/pool-banner.jpg') }}') no-repeat center center / cover;">
                    <div class="item__container">
                        <div class="item-container__inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="item__content">
                                            <h1 class="item_content__title">Experience <span>Nature</span></h1>
                                            <div class="divider">
                                                <hr class="line1">
                                                <hr class="line2">
                                                <hr class="line1">
                                            </div> <!-- / .divider -->
                                            <p class="item_content__desc">Hotel Valerie on the shores of Kuramo lagoon</p>
                                            <a href="#section__about" class="btn btn-reservation">Explore it</a>
                                        </div> <!-- .slide__content -->
                                    </div>
                                </div> <!-- / .row -->
                            </div> <!-- / .container -->
                        </div> <!-- / .item-container__inner -->
                    </div> <!-- / .item__container -->
                </div> <!-- / .item -->

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <img src="{{ asset('assets/img/arrow_left.svg') }}" alt="Prev">
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <img src="{{ asset('assets/img/arrow_right.svg') }}" alt="Next">
                </a>
            </div><!-- /.carousel-inner -->
        </div><!-- /.carousel -->
    </section> <!-- / .section__home -->

    <div id="booking-section"></div>

    <!-- section about -->
    <section class="section__about" id="section__about">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section__title">Welcome to <strong>{{ env('HOTEL_NAME') }}</strong></h2>
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
                            {!! $welcomeContent ? $welcomeContent['content'] : '' !!}
                            <a href="{{ route('page.about') }}" class="btn btn-default">Learn More</a>
                        </div> <!-- / .about__desc -->
                    </div>
                </div> <!-- / .section_about__content -->
            </div> <!-- / .row -->
        </div>
    </section> <!-- / .section__about -->

    <!-- section best-rooms -->
    <section class="section__best-rooms">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section__title">Our <strong> rooms</strong></h2>
                    <div class="divider">
                        <hr class="line1">
                        <hr class="line2">
                        <hr class="line1">
                    </div> <!-- / .divider -->
                    <p class="section__subtitle">
                        {!! $roomContent ? strip_tags($roomContent['content']) : '' !!}
                    </p>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="container">
            <div class="best-rooms__content">
                @foreach($roomTypes AS $room)
                    @if($loop->iteration % 2 == 1 || $loop->first)
                        <div class="row">
                    @endif
                    <div class="col-sm-6">
                        <figure class="best-rooms__item">
                            <img src="{{ count($room->media) > 0 ? asset('storage/'.$room->media[0]->file) : '' }}" class="img-responsive" alt="...">
                            <figcaption>
                                <h3>{{ $room->title }}</h3>
                                <div class="item__price">
                                    &#8358;{{ number_format($room->base_price_per_night, 2) }}<small>/ night</small>
                                </div>
                                <p class="item__desc">{{ $room->short_description }}</p>
                                <a href="#" class="btn-book">Book now <i class="icon ion-chevron-right"></i><i class="icon ion-chevron-right"></i></a>
                                <a href="{{ route('rooms.show', ['slug' => $room->slug]) }}" class="btn-book">Find out more</a>
                            </figcaption>
                        </figure> <!-- / .best-rooms__item -->
                    </div>
                    @if($loop->iteration % 2 == 0 || $loop->last)
                        </div>
                     @endif
                @endforeach
                <div class="row">
                    <div class="col-xs-12">
                        <div class="rooms__button">
                            <a href="{{ route('rooms.index') }}" class="btn">See all rooms</a>
                        </div> <!-- / .rooms__button -->
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .best-rooms__content -->
        </div> <!-- / .container -->
    </section> <!-- / .section__best-rooms -->

    <!-- section services -->
    <section class="section__services">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="services__item">
                        <h2 class="services_item__title">Luxury Rooms</h2>
                        <div class="services_item__divider">
                            <i class="icon ion-android-star"></i>
                            <i class="icon ion-android-star"></i>
                            <i class="icon ion-android-star"></i>
                        </div> <!-- .services_item__divider -->
                        <p class="services_item__desc">
                            Our stylish rooms and suites in our luxury hotel have been beautifully designed with hotel’s philosophy of understated luxury and supreme comfort.
                        </p>
                    </div> <!-- .services__item -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="services__item">
                        <h2 class="services_item__title">Restaurant & Bar</h2>
                        <div class="services_item__divider">
                            <i class="icon ion-android-star"></i>
                            <i class="icon ion-android-star"></i>
                            <i class="icon ion-android-star"></i>
                        </div> <!-- .services_item__divider -->
                        <p class="services_item__desc">
                            In a cozy atmosphere you can enjoy not only our Local delicacies but also our intercontinental-style cuisine with an African touch.
                        </p>
                    </div> <!-- .services__item -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="services__item">
                        <h2 class="services_item__title">Meetings & Events Center</h2>
                        <div class="services_item__divider">
                            <i class="icon ion-android-star"></i>
                            <i class="icon ion-android-star"></i>
                            <i class="icon ion-android-star"></i>
                        </div> <!-- .services_item__divider -->
                        <p class="services_item__desc">
                            Our events facilities include all equipments with the state-of-the-art audio & visual and  business support unit.
                        </p>
                    </div> <!-- .services__item -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="services__item">
                        <h2 class="services_item__title">Fitness Center</h2>
                        <div class="services_item__divider">
                            <i class="icon ion-android-star"></i>
                            <i class="icon ion-android-star"></i>
                            <i class="icon ion-android-star"></i>
                        </div> <!-- .services_item__divider -->
                        <p class="services_item__desc">
                            Hotel Valerie presents an awesome fitness facility to make you feel good. Just exactly what you need to keep fit
                        </p>
                    </div> <!-- .services__item -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section> <!-- / .section__services -->

    <!-- section gallery -->
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
                    <p class="section__subtitle">
                        {!! $galleryContent ? strip_tags($galleryContent['content']) : '' !!}
                    </p>
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

    <!-- section testimonials -->
    <section class="section__testimonials">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section__title"><strong>Testimonials</strong></h2>
                    <div class="divider">
                        <hr class="line1">
                        <hr class="line2">
                        <hr class="line1">
                    </div> <!-- / .divider -->
                    <p class="section__subtitle testimonials__subtitle">
                        {!! $testimonialContent ? strip_tags($testimonialContent['content']) : '' !!}
                    </p>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div id="testimonials__carousel" class="owl-carousel owl-theme testimonials__body">
                        <div class="testimonials__wrapper">
                            <div class="testimonials__item">
                                <div class="testimonials__img">
                                    <img src="{{ asset('images/user.svg') }}" class="img-responsive" alt="...">
                                </div>
                                <div class="testimonials__caption">
                                    <h3 class="testimonials_caption__name">John Ajuranki</h3>
                                    <p class="testimonials_caption__prof">Lawyer</p>
                                    <p class="testimonials_caption__text">
                                        Many thanks for the wonderful service and kindness extended to our group. We will recommend Hotel Valerie every time!!
                                    </p>
                                </div> <!-- .testimonials__caption -->
                            </div> <!-- .testimonials__item -->
                        </div><!-- .testimonials__wrapper -->
                        <div class="testimonials__wrapper">
                            <div class="testimonials__item">
                                <div class="testimonials__img">
                                    <img src="{{ asset('images/user.svg') }}" class="img-responsive" alt="...">
                                </div>
                                <div class="testimonials__caption">
                                    <h3 class="testimonials_caption__name">Maria Okigbe</h3>
                                    <p class="testimonials_caption__prof">Business woman</p>
                                    <p class="testimonials_caption__text">My stay exceeded my expectations...room, comfy-like home. All of the extras are here. The business center is a major convenience-very nice!</p>
                                </div> <!-- .testimonials__caption -->
                            </div> <!-- .testimonials__item -->
                        </div><!-- .testimonials__wrapper -->
                    </div> <!-- .testimonials__body -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section> <!-- / .section__testimonials -->

    @if(false)
    <section class="section__events">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section__title">Our news <strong>& events</strong></h2>
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
                <div class="col-xs-12 hidden-xs col-sm-6 col-md-6 col-lg-3 col-lg-push-9">
                    <div class="news__title">
                        <div>News</div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-lg-pull-3">
                    <div class="events__item">
                        <div class="events-item__img">
                            <img src="assets/img/events_img1.jpg" class="img-responsive" alt="...">
                        </div>
                        <div class="events-item__body">
                            <div class="events-item__header">
                                <div class="events-item__date">
                                    <p class="item_date__nbr">15</p>
                                    <p class="item_date__mounth">March</p>
                                </div> <!-- .events-item__date -->
                                <div class="events-item__content">
                                    <div class="events-item__title">
                                        <h3>News post title</h3>
                                    </div>
                                    <div class="events-item__info">
                                        <ul class="item-info__list">
                                            <li class="info-list__item"><i class="ion ion-android-person"></i> by John Doe</li>
                                            <li class="info-list__item"><i class="ion ion-android-chat" aria-hidden="true"></i> 5 Comments</li>
                                        </ul> <!-- .item-info__list -->
                                    </div> <!-- .events-item__info -->
                                </div> <!-- .events-item__content -->
                            </div> <!-- .events-item__header -->
                            <div class="events-item__text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eius dicta, magni, placeat sed excepturi tenetur. Unde esse repellendus saepe ipsa odio in laborum voluptas. Obcaecati quae.
                            </div> <!-- .events-item__text -->
                            <div class="events-item__link">
                                <a href="blog-item.html">Read More ➔</a>
                            </div> <!-- .events-item__link -->
                        </div> <!-- / .events-item__body -->
                    </div> <!-- .events__item -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-lg-pull-3">
                    <div class="events__item">
                        <div class="events-item__img">
                            <img src="assets/img/events_img2.jpg" class="img-responsive" alt="...">
                        </div>
                        <div class="events-item__body">
                            <div class="events-item__header">
                                <div class="events-item__date">
                                    <p class="item_date__nbr">18</p>
                                    <p class="item_date__mounth">March</p>
                                </div> <!-- .events-item__date -->
                                <div class="events-item__content">
                                    <div class="events-item__title">
                                        <h3>News post title</h3>
                                    </div>
                                    <div class="events-item__info">
                                        <ul class="item-info__list">
                                            <li class="info-list__item"><i class="ion ion-android-person"></i> by John Doe</li>
                                            <li class="info-list__item"><i class="ion ion-android-chat" aria-hidden="true"></i> 7 Comments</li>
                                        </ul> <!-- .item-info__list -->
                                    </div> <!-- .events-item__info -->
                                </div> <!-- .events-item__content -->
                            </div> <!-- .events-item__header -->
                            <div class="events-item__text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eius dicta, magni, placeat sed excepturi tenetur. Unde esse repellendus saepe ipsa odio in laborum voluptas. Obcaecati quae.
                            </div> <!-- .events-item__text -->
                            <div class="events-item__link">
                                <a href="blog-item.html">Read More ➔</a>
                            </div> <!-- .events-item__link -->
                        </div> <!-- / .events-item__body -->
                    </div> <!-- .events__item -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-lg-pull-3">
                    <div class="events__item">
                        <div class="events-item__img">
                            <img src="assets/img/events_img3.jpg" class="img-responsive" alt="...">
                        </div>
                        <div class="events-item__body">
                            <div class="events-item__header">
                                <div class="events-item__date">
                                    <p class="item_date__nbr">21</p>
                                    <p class="item_date__mounth">March</p>
                                </div> <!-- .events-item__date -->
                                <div class="events-item__content">
                                    <div class="events-item__title">
                                        <h3>News post title</h3>
                                    </div>
                                    <div class="events-item__info">
                                        <ul class="item-info__list">
                                            <li class="info-list__item"><i class="ion ion-android-person"></i> by John Doe</li>
                                            <li class="info-list__item"><i class="ion ion-android-chat" aria-hidden="true"></i> 9 Comments</li>
                                        </ul> <!-- .item-info__list -->
                                    </div> <!-- .events-item__info -->
                                </div> <!-- .events-item__content -->
                            </div> <!-- .events-item__header -->
                            <div class="events-item__text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eius dicta, magni, placeat sed excepturi tenetur. Unde esse repellendus saepe ipsa odio in laborum voluptas. Obcaecati quae.
                            </div> <!-- .events-item__text -->
                            <div class="events-item__link">
                                <a href="blog-item.html">Read More ➔</a>
                            </div> <!-- .events-item__link -->
                        </div> <!-- / .events-item__body -->
                    </div> <!-- .events__item -->
                </div>
            </div> <!-- / .row -->
            <div class="row">
                <div class="col-xs-12 hidden-xs col-sm-6 col-md-6 col-lg-3">
                    <div class="events__title">
                        <div>Events</div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="events__item ">
                        <div class="events-item__img">
                            <img src="assets/img/events_img4.jpg" class="img-responsive" alt="...">
                        </div>
                        <div class="events-item__body">
                            <div class="events-item__header">
                                <div class="events-item__date">
                                    <p class="item_date__nbr">11</p>
                                    <p class="item_date__mounth">April</p>
                                </div> <!-- .events-item__date -->
                                <div class="events-item__content">
                                    <div class="events-item__title">
                                        <h3>Event post title</h3>
                                    </div>
                                    <div class="events-item__info">
                                        <ul class="item-info__list">
                                            <li class="info-list__item"><i class="ion ion-android-person"></i> by John Doe</li>
                                            <li class="info-list__item"><i class="ion ion-android-chat" aria-hidden="true"></i> 2 Comments</li>
                                        </ul> <!-- .item-info__list -->
                                    </div> <!-- .events-item__info -->
                                </div> <!-- .events-item__content -->
                            </div> <!-- .events-item__header -->
                            <div class="events-item__text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eius dicta, magni, placeat sed excepturi tenetur. Unde esse repellendus saepe ipsa odio in laborum voluptas. Obcaecati quae.
                            </div> <!-- .events-item__text -->
                            <div class="events-item__link">
                                <a href="blog-item.html">Read More ➔</a>
                            </div> <!-- .events-item__link -->
                        </div> <!-- / .events-item__body -->
                    </div> <!-- .events__item -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="events__item">
                        <div class="events-item__img">
                            <img src="assets/img/events_img5.jpg" class="img-responsive" alt="...">
                        </div>
                        <div class="events-item__body">
                            <div class="events-item__header">
                                <div class="events-item__date">
                                    <p class="item_date__nbr">14</p>
                                    <p class="item_date__mounth">April</p>
                                </div> <!-- .events-item__date -->
                                <div class="events-item__content">
                                    <div class="events-item__title">
                                        <h3>Event post title</h3>
                                    </div>
                                    <div class="events-item__info">
                                        <ul class="item-info__list">
                                            <li class="info-list__item"><i class="ion ion-android-person"></i> by John Doe</li>
                                            <li class="info-list__item"><i class="ion ion-android-chat" aria-hidden="true"></i> 11 Comments</li>
                                        </ul> <!-- .item-info__list -->
                                    </div> <!-- .events-item__info -->
                                </div> <!-- .events-item__content -->
                            </div> <!-- .events-item__header -->
                            <div class="events-item__text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eius dicta, magni, placeat sed excepturi tenetur. Unde esse repellendus saepe ipsa odio in laborum voluptas. Obcaecati quae.
                            </div> <!-- .events-item__text -->
                            <div class="events-item__link">
                                <a href="blog-item.html">Read More ➔</a>
                            </div> <!-- .events-item__link -->
                        </div> <!-- / .events-item__body -->
                    </div> <!-- .events__item -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="events__item">
                        <div class="events-item__img">
                            <img src="assets/img/events_img6.jpg" class="img-responsive" alt="...">
                        </div>
                        <div class="events-item__body">
                            <div class="events-item__header">
                                <div class="events-item__date">
                                    <p class="item_date__nbr">16</p>
                                    <p class="item_date__mounth">April</p>
                                </div> <!-- .events-item__date -->
                                <div class="events-item__content">
                                    <div class="events-item__title">
                                        <h3>Event post title</h3>
                                    </div>
                                    <div class="events-item__info">
                                        <ul class="item-info__list">
                                            <li class="info-list__item"><i class="ion ion-android-person"></i> by John Doe</li>
                                            <li class="info-list__item"><i class="ion ion-android-chat" aria-hidden="true"></i> 8 Comments</li>
                                        </ul> <!-- .item-info__list -->
                                    </div> <!-- .events-item__info -->
                                </div> <!-- .events-item__content -->
                            </div> <!-- .events-item__header -->
                            <div class="events-item__text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eius dicta, magni, placeat sed excepturi tenetur. Unde esse repellendus saepe ipsa odio in laborum voluptas. Obcaecati quae.
                            </div> <!-- .events-item__text -->
                            <div class="events-item__link">
                                <a href="blog-item.html">Read More ➔</a>
                            </div> <!-- .events-item__link -->
                        </div> <!-- / .events-item__body -->
                    </div> <!-- .events__item -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section> <!-- / .section__events -->

    <!-- section Contacts -->
    <section class="section__contacts">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section__title"><strong>Contact</strong> us</h2>
                    <div class="divider">
                        <hr class="line1">
                        <hr class="line2">
                        <hr class="line1">
                    </div> <!-- / .divider -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="section_row">
            <div id="map"></div>
        </div> <!-- / .section_row -->
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="contacts__info">
                        <p class="contacts_info__title">Information</p>
                        <ul class="contacts_info__content">
                            <li>
                                <i class="icon ion-android-pin"></i>
                                <div class="contact-info-content">
                                    <div class="title">Address</div>
                                    <div class="description">10987 1st Avenue, Lorem City, CA</div>
                                </div>
                            </li>
                            <li>
                                <i class="icon ion-android-call"></i>
                                <div class="contact-info-content">
                                    <div class="title">Phone / Fax</div>
                                    <div class="description">+45 789 123 4544 / +45 789 123 4848</div>
                                </div>
                            </li>
                            <li>
                                <i class="icon ion-android-mail"></i>
                                <div class="contact-info-content">
                                    <div class="title">E-mail</div>
                                    <div class="description">admin@sunsethotel.com</div>
                                </div>
                            </li>
                        </ul> <!-- .contacts_info__content -->
                    </div> <!-- / .contacts__info -->
                    <p class="subheading">If you have any questions don't hesistate to contact us.</p>
                </div>
                <div class="col-sm-7">
                    <div class="section-contacts__form_body">

                        <p class="section-contacts__title">Get in touch</p>

                        <!-- Please carefully read the README file in order to setup the PHP contact form properly -->

                        <!-- Alert message -->
                        <div class="alert" id="form_message" role="alert"></div>

                        <!-- Form -->
                        <form id="form_sendemail" class="contacts__form">

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="sr-only">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address">
                                <span class="help-block"></span>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="sr-only">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">
                                <span class="help-block"></span>
                            </div>

                            <!-- Message -->
                            <div class="form-group">
                                <label for="message" class="sr-only">Message</label>
                                <textarea name="message" class="form-control" id="message" rows="6" placeholder="Enter your message"></textarea>
                                <span class="help-block"></span>
                            </div>

                            <!-- Note -->
                            <div class="form-group">
                                <small class="text-muted">
                                    * All fields are mandatory.
                                </small>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-default">
                                Send Message
                            </button>

                        </form> <!-- .contacts__form -->

                    </div> <!-- / .secction-contacts__form_body -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section> <!-- / .section__contacts -->
    @endif

@endsection

@section('scripts')
    <script src="{{ asset('js/booking.js') }}"></script>
@endsection