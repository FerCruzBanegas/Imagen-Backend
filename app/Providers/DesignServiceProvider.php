<?php

namespace App\Providers;

use App\Design;
use Illuminate\Support\ServiceProvider;
use App\Observers\DesignObserver;

class DesignServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Design::observe(DesignObserver::class);
    }
}
