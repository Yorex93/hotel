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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Home
                    </a>
                </li>
                <li><a href="{{ route('page.about') }}">About Us</a></li>
                <li>
                    <a href="{{ route('rooms.index') }}">
                        Rooms
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('services.index') }}">Services</a></li>
                <li><a href="{{ route('facilities.index') }}">Facilities</a></li>
                <li><a href="{{ route('page.contact') }}">Contact</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container -->
</nav>