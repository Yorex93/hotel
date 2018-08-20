<?php

namespace Hotel\Providers;

use Hotel\Entities\Activity;
use Hotel\Entities\Coupon;
use Hotel\Entities\Facility;
use Hotel\Entities\Hotel;
use Hotel\Entities\RoomType;
use Hotel\Entities\Service;

use Hotel\Services\Facility\DefaultFacilityService;
use Hotel\Services\Facility\FacilityService;
use Hotel\Services\File\FileService;
use Hotel\Services\File\LocalStorageFileService;
use Hotel\Services\Hotel\DefaultHotelService;
use Hotel\Services\Hotel\HotelService;
use Hotel\Services\HotelServices\DefaultHotelServicesService;
use Hotel\Services\HotelServices\HotelServicesService;
use Hotel\Services\Location\DefaultLocationService;
use Hotel\Services\Location\LocationService;
use Hotel\Services\Media\DefaultMediaService;
use Hotel\Services\Media\MediaService;
use Hotel\Services\RoomType\DefaultRoomTypeService;
use Hotel\Services\RoomType\RoomTypeService;
use Hotel\ViewComposers\NavComposer;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
		    'services' => Service::class,
		    'hotel_services' => \Hotel\Entities\HotelService::class
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
	    $this->app->bind(FileService::class, LocalStorageFileService::class);
        $this->app->bind(HotelService::class, DefaultHotelService::class);
        $this->app->bind(LocationService::class, DefaultLocationService::class);
        $this->app->bind(RoomTypeService::class, DefaultRoomTypeService::class);
        $this->app->bind(MediaService::class, DefaultMediaService::class);
        $this->app->bind(FacilityService::class, DefaultFacilityService::class);
        $this->app->bind(HotelServicesService::class, DefaultHotelServicesService::class);
    }
}
