<div class="section__info">
    <div class="container">
        <div class="section_info__body">
            <div class="info__column-left">
                <div class="section_info__contact hidden-xs">
                    <p>
                        <i class="icon ion-android-pin"></i> 3-11 Hotel Valerie Road, off DLA Road, Asaba, Delta State
                    </p>
                </div> <!-- .section_info__contact -->
                <div class="section_info__contact hidden-xs">
                    <p>
                        <i class="icon ion-android-call"></i> (+234) 706 915 3923,
                    </p>
                </div> <!-- .section_info__contact -->
            </div> <!-- .info__column-left -->
            <div class="info__column-right">
                <ul class="social__icons">
                    <li class="social-icons__item"><a href="#"><i class="icon ion-social-twitter" aria-hidden="true"></i></a></li>
                    <li class="social-icons__item"><a href="#"><i class="icon ion-social-facebook" aria-hidden="true"></i></a></li>
                    <li class="social-icons__item"><a href="#"><i class="icon ion-social-googleplus" aria-hidden="true"></i></a></li>
                </ul> <!-- .social__icons -->
                <a href="{{ 1 == 2 ? route('reservations.index') : '#' }}" class="btn btn-reservation-top">Reservations</a>

                @if(false)
                <div class="dropdown lang-menu">
                    <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        En
                        <i class="icon ion-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Fr</a></li>
                        <li><a href="#">Es</a></li>
                        <li><a href="#">Ru</a></li>
                    </ul>
                </div> <!-- .lang-menu -->
                <form class="search-form hidden-xs" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default btn-search"><i class="icon ion-search"></i></button>
                </form> <!-- .search-form -->
                @endif

            </div> <!-- .info__column-right -->
        </div> <!-- .section_info__body -->
    </div> <!-- .container -->
</div>