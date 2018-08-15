@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <!-- section text header -->
    <section class="section__text-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="welcome__content">
                        <h1 class="welcome_content__title">{{ $roomType->title }}</h1>
                        <div class="divider blog-divider">
                            <hr class="line1">
                            <hr class="line2">
                            <hr class="line1">
                        </div> <!-- / .divider -->
                    </div> <!-- .welcome__content -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section> <!-- / .section text-header -->

    <!-- section room-detail -->
    <section class="section__room-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-8">
                    <div class="room_detail__body">
                        <div id="room-detail__carousel" class="owl-carousel owl-theme room-detail__gallery">
                            @foreach($roomType->media AS $media)
                            <div class="room_gallery__item">
                                <img src="{{ asset('storage/'.$media->file) }}" class="img-responsive" alt="...">
                            </div> <!-- .room_gallery__item -->
                            @endforeach
                        </div> <!-- .room-detail__gallery -->
                        <div class="room_price__body">
                            <h2 class="room__name">{{ $roomType->title }}</h2>
                            <p class="room__price"><span>&#8358;{{ number_format($roomType->base_price_per_night, 2) }}</span> / night</p>
                        </div>
                        <p class="subheading">Room description</p>
                        <div class="room__desc">
                            {!! $roomType->short_description !!}
                        </div>

                        <div class="room__desc">
                            {!! $roomType->description !!}
                        </div>

                        <a href="#" class="btn">Book this room now</a>
                    </div> <!-- .room-detail__body -->
                    <div class="room__reviews">
                        <p class="subheading">Room reviews</p>
                        <ul class="reviews__list">
                            <li class="review">
                                <div class="review__user">
                                    Robert Uzeba
                                </div>
                                <div class="review__date">
                                    April 8, 2018 at 1:15 pm
                                </div>
                                <div class="review__message">
                                    My stay exceeded my expectations...room, comfy-like home. All of the extras are here. The business center is a major convenience-very nice!
                                </div>
                            </li> <!-- .review -->
                        </ul> <!-- .reviews__list -->

                        @if(false)
                            <p class="subheading">Leave a review</p>
                        <form class="comments__form" data-animate-in="animateUp">

                            <div class="form-group">
                                <label for="name">Name (Required)</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Your Full Name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your E-mail">
                            </div>

                            <div class="form-group">
                                <label for="message">Comment (Required)</label>
                                <textarea name="message" class="form-control" rows="6" id="message" placeholder="Enter Your Comment"></textarea>
                                <span class="help-block"></span>
                            </div>

                            <button type="submit" class="btn">
                                Submit review
                            </button>
                        </form>
                        @endif
                    </div> <!-- .room__reviews -->
                </div>
                <div class="col-sm-5 col-md-4">
                    <div class="room-detail__sidebar">
                        <div class="room_features__body">
                            <p class="subheading">Room features</p>
                            <ul class="room__features">
                                <li class="feature__item">
                                    <i class="icon ion-android-people"></i>
                                    <div class="feature_item__title">
                                        Double king bed
                                    </div>
                                </li>
                                <li class="feature__item">
                                    <i class="icon ion-coffee"></i>
                                    <div class="feature_item__title">
                                        Breakfast
                                    </div>
                                </li>
                                <li class="feature__item">
                                    <i class="icon ion-android-sunny"></i>
                                    <div class="feature_item__title">
                                        Air conditioning
                                    </div>
                                </li>
                                <li class="feature__item">
                                    <i class="icon ion-wineglass"></i>
                                    <div class="feature_item__title">
                                        Mini bar
                                    </div>
                                </li>
                                <li class="feature__item">
                                    <i class="icon ion-wifi"></i>
                                    <div class="feature_item__title">
                                        Wi-Fi service
                                    </div>
                                </li>
                                <li class="feature__item">
                                    <i class="icon ion-model-s"></i>
                                    <div class="feature_item__title">
                                        Free parking
                                    </div>
                                </li>
                            </ul> <!-- .room__features -->
                        </div> <!-- .room_features__body -->
                        <div class="similar__rooms">
                            <p class="subheading">Similar rooms</p>
                            <ul class="similar-rooms__list">
                                @foreach(collect($roomTypes)->take(2) AS $room)
                                <li class="list__item">
                                    <a href="{{ route('rooms.show', ['slug' => $room->slug]) }}">
                                        <figure class="list_item__body">
                                            <img src="{{ count($room->media) > 0 ? asset('storage/'.$room->media[0]->file) : '' }}" class="img-responsive" alt="...">
                                            <figcaption>
                                                <h3>{{ $room->title }}</h3>
                                                <div class="item__price">
                                                    &#8358;{{ number_format($room->base_price_per_night, 2) }} <small>/ night</small>
                                                </div>
                                            </figcaption>
                                        </figure> <!-- / .list_item__body -->
                                    </a>
                                </li>  <!-- .list__item -->
                                @endforeach
                            </ul> <!-- .similar-rooms__list -->
                        </div> <!-- .similar__rooms -->
                        <div class="info__body">
                            <p class="info__title">Information</p>
                            <ul class="info__content">
                                <li>
                                    <p class="info-text">For more information about rooms please contact us.</p>
                                </li>
                                <li>
                                    <i class="icon ion-android-pin"></i>
                                    <div class="info-content">
                                        <div class="title">Address</div>
                                        <div class="description">3-11 Hotel Valerie Road, off DLA Road, Asaba, Delta State</div>
                                    </div>
                                </li>
                                <li>
                                    <i class="icon ion-android-call"></i>
                                    <div class="info-content">
                                        <div class="title">Phone</div>
                                        <div class="description">(+234) 706 915 3923</div>
                                    </div>
                                </li>
                                <li>
                                    <i class="icon ion-android-mail"></i>
                                    <div class="info-content">
                                        <div class="title">E-mail</div>
                                        <div class="description">info@hotelvaleriesuites.com</div>
                                    </div>
                                </li>
                            </ul> <!-- .info__content -->
                        </div> <!-- / .info__body -->
                    </div> <!-- .room-detail__sidebar -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section> <!-- / .section reservation -->
@endsection

@section('scripts')

@endsection