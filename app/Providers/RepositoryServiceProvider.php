<?php

namespace Hotel\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Hotel\Repositories\HotelRepository::class, \Hotel\Repositories\HotelRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\LocationRepository::class, \Hotel\Repositories\LocationRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\ContactPersonRepository::class, \Hotel\Repositories\ContactPersonRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\StateRepository::class, \Hotel\Repositories\StateRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\CountryRepository::class, \Hotel\Repositories\CountryRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\RoomRepository::class, \Hotel\Repositories\RoomRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\PriceTypeRepository::class, \Hotel\Repositories\PriceTypeRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\RoomServiceRepository::class, \Hotel\Repositories\RoomServiceRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\ServiceRepository::class, \Hotel\Repositories\ServiceRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\FacilityRepository::class, \Hotel\Repositories\FacilityRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\HasFacilityRepository::class, \Hotel\Repositories\HasFacilityRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\ActivityRepository::class, \Hotel\Repositories\ActivityRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\DurationUnitRepository::class, \Hotel\Repositories\DurationUnitRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\HotelActivitiesRepository::class, \Hotel\Repositories\HotelActivitiesRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\ActivitySessionRepository::class, \Hotel\Repositories\ActivitySessionRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\ActivitySessionTimeRepository::class, \Hotel\Repositories\ActivitySessionTimeRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\CouponRepository::class, \Hotel\Repositories\CouponRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\RoomCouponRepository::class, \Hotel\Repositories\RoomCouponRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\TaxRepository::class, \Hotel\Repositories\TaxRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\MediaRepository::class, \Hotel\Repositories\MediaRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\HasMediaRepository::class, \Hotel\Repositories\HasMediaRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\ReviewRepository::class, \Hotel\Repositories\ReviewRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\ReviewableRepository::class, \Hotel\Repositories\ReviewableRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\TagRepository::class, \Hotel\Repositories\TagRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\TaggableRepository::class, \Hotel\Repositories\TaggableRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\SlideShowRepository::class, \Hotel\Repositories\SlideShowRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\PageRepository::class, \Hotel\Repositories\PageRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\PageItemRepository::class, \Hotel\Repositories\PageItemRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\EmailTemplateRepository::class, \Hotel\Repositories\EmailTemplateRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\SocialRepository::class, \Hotel\Repositories\SocialRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\HotelSocialRepository::class, \Hotel\Repositories\HotelSocialRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\RoomTypeRepository::class, \Hotel\Repositories\RoomTypeRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\BookingRepository::class, \Hotel\Repositories\BookingRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\BookingServiceRepository::class, \Hotel\Repositories\BookingServiceRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\BookingActivityRepository::class, \Hotel\Repositories\BookingActivityRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\BookingRoomRepository::class, \Hotel\Repositories\BookingRoomRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\PaymentRepository::class, \Hotel\Repositories\PaymentRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\PaymentMethodRepository::class, \Hotel\Repositories\PaymentMethodRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\TestimonialRepository::class, \Hotel\Repositories\TestimonialRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\HotelServiceRepository::class, \Hotel\Repositories\HotelServiceRepositoryEloquent::class);
        $this->app->bind(\Hotel\Repositories\HotelSettingsRepository::class, \Hotel\Repositories\HotelSettingsRepositoryEloquent::class);
        //:end-bindings:
    }
}
