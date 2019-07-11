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
                        <h1 class="welcome_content__title">Reservations</h1>

                        <!-- Breadcrumbs -->
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active">Reservations</li>
                        </ol>

                        <p class="welcome_content__desc">Book a room</p>
                    </div> <!-- .welcome__content -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="home__bg rooms__bg" style="background-image: url({{ asset('images/reservations-banner.jpeg') }})"></div>
    </section> <!-- / .section__header -->

    <!-- section rooms-1 -->
    <div id="booking-section"></div>

@endsection

@section('scripts')
    <script src="{{ asset('js/booking.js') }}"></script>
@endsection