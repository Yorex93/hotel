@php

    $food_beverages = collect($navServices)->filter(function($value){
        return $value->category == 'FOOD-BEVERAGES';
    });

    $spa_fitness = collect($navServices)->first(function($value){
        return $value->category == 'SPA-FITNESS';
    });

@endphp

<nav class="navbar navbar-default">
    <div class="container">

        <!-- Header -->
        <div class="navbar-header">

            <!-- Collapse toggle -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar__collapse" aria-expanded="false">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/valerie-logo.png') }}" />
            </a>

        </div> <!-- / .navbar-header -->

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbar__collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li><a href="{{ route('page.about') }}">About Us</a></li>
                <li>
                    <a href="{{ route('rooms.index') }}">
                        Rooms
                    </a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Food & Beverage <i class="icon ion-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            @foreach($food_beverages AS $item)
                                <li>
                                    <a href="{{ route('hotel-services.show', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Spa Arena <i class="icon ion-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            @foreach($spa_fitness->children AS $item)
                                <li>
                                    <a href="{{ route('hotel-services.show', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Facilities <i class="icon ion-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($navFacilities AS $item)
                            <li>
                                <a href="{{ route('facilities.show', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ route('page.contact') }}">Contact</a></li>
                {{--<li><a href="{{ route('services.index') }}">Services</a></li>--}}


            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container -->
</nav>