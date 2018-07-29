<?php

namespace Hotel\Providers;

use Hotel\Entities\Activity;
use Hotel\Entities\Coupon;
use Hotel\Entities\Facility;
use Hotel\Entities\Hotel;
use Hotel\Entities\Room;
use Hotel\Entities\Service;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Schema::defaultStringLength(191);

	    Relation::morphMap([
		    'hotels' => Hotel::class,
		    'rooms' => Room::class,
		    'activities' => Activity::class,
		    'coupons' => Coupon::class,
		    'facilities' => Facility::class,
		    'services' => Service::class
	    ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
