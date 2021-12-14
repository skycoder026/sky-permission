<?php

namespace Skycoder\SkyPermission;

use Illuminate\Support\ServiceProvider;

class SkyPermissionServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');


        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');


        $this->loadViewsFrom(__DIR__ . '/views', 'sky-permission');


        $this->publishes(
            [__DIR__ . '/views' => base_path('resources/views/vendor/sky-permission')],
            'sky-permission'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
