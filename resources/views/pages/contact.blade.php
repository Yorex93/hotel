@extends('layouts.app')

@section('styles')
    <style>
        .section__contacts-alt .contacts__info .contacts_info__title{
            margin-bottom: 20px
        }

        .section__contacts-alt .contacts__info .contacts_info__content > li{
            padding: 10px 0
        }

        .contact-info-text {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 0;
        }

        .section__contacts-alt .contacts__info .contacts_info__content > li .contact-info-content .title{
            font-size: 14px;
        }

        .section__contacts-alt .contacts__info .contacts_info__content > li > i{
            font-size: 30px;
            margin-top: 0;
        }

        .section__contacts-alt .subheading{
            font-size: 30px
        }

        .contacts__form > .form-group > input{
            height: 50px
        }
    </style>
@endsection


@section('content')
    <section class="section__header" id="section__header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="welcome__content">

                        <h2 class="welcome_content__title">Contact us</h2>

                        <!-- Breadcrumbs -->
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active">Contact us</li>
                        </ol>

                    </div> <!-- .welcome__content -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="home__bg about__bg" style="background: url({{ asset('images/pool-banner.jpg') }});"></div>
    </section> <!-- / .section__header -->

    <section class="section__contacts-alt">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="subheading">If you have any questions don't hesistate to contact us.</h1>
                </div>
            </div> <!-- / .row -->
            <div class="row">
                <div class="col-sm-7">
                    <div class="section-contacts__form_body">
                        <p class="section-contacts__title">Get in touch</p>

                        <div class="alert {{ session('success') ? 'alert-success' : '' }}{{ $errors->any() || session('failed') ? 'alert-danger' : '' }}">
                            @if(session('success'))
                                {{ collect($pageItems)->firstWhere('for', 'contact.success-message')['content'] }}
                            @endif

                            @if(session('failed'))
                                {{ session('failed', 'An error occurred') }}
                            @endif

                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                     <!-- Form -->
                        <form class="contacts__form" action="{{ route('contact.submit') }}" method="POST">
                            <!-- Email -->
                            {{ csrf_field() }}
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="sr-only">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required value="{{ old('name') }}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="sr-only">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your Phone Number" required value="{{ old('phone') }}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="email" class="sr-only">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" required value="{{ old('email') }}">
                                <span class="help-block"></span>
                            </div>

                            <!-- Message -->
                            <div class="form-group">
                                <label for="message" class="sr-only">Message</label>
                                <textarea name="message" class="form-control" id="message" rows="6" placeholder="Enter your message" required>{{  old('message') }}</textarea>
                                <span class="help-block"></span>
                            </div>

                            <button type="submit" class="btn btn-default">
                                Send Message
                            </button>
                        </form> <!-- .contacts__form -->

                    </div> <!-- / .section-contacts__form_body -->
                </div>
                <div class="col-sm-5">
                    <div class="contacts__info">
                        <p class="contacts_info__title">Contact us</p>
                        @foreach($hotels AS $hotel)
                            @if($hotel->location != null)
                                <ul class="contacts_info__content">
                                    <li>
                                        <p class="contact-info-text">{{ $hotel->name }}</p>
                                    </li>
                                    <li>
                                        <i class="icon ion-android-pin"></i>
                                        <div class="contact-info-content">
                                            <div class="title">Address</div>
                                            <div class="description">
                                                {{ $hotel->location->address }}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <i class="icon ion-android-call"></i>
                                        <div class="contact-info-content">
                                            <div class="title">Phone / Fax</div>
                                            <div class="description">{{ $hotel->location->phone }}</div>
                                        </div>
                                    </li>
                                    <li>
                                        <i class="icon ion-android-mail"></i>
                                        <div class="contact-info-content">
                                            <div class="title">E-mail</div>
                                            <div class="description">{{ $hotel->location->email }}</div>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                        @endforeach
                    </div> <!-- / .contacts__info -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        @if(false)
        <div class="section_row">
            <div id="map"></div>
        </div> <!-- / .section_row -->
        @endif
    </section>

@endsection


@section('scripts')

@endsection