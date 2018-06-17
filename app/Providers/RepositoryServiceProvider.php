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
        //:end-bindings:
    }
}
