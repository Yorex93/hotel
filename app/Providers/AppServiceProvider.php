<?php

namespace Hotel\Providers;

use Hotel\Entities\Activity;
use Hotel\Entities\Coupon;
use Hotel\Entities\Facility;
use Hotel\Entities\Hotel;
use Hotel\Entities\RoomType;
use Hotel\Entities\Service;

use Hotel\Services\Hotel\DefaultHotelService;
use Hotel\Services\Hotel\HotelService;
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
		    'room_types' => RoomType::class,
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
	    $this->app->register(RepositoryServiceProvider::class);
        $this->app->bind(HotelService::class, DefaultHotelService::class);
    }
}
