<?php

namespace App\Providers;

use App\Services\DataTransfer;
use Illuminate\Support\ServiceProvider;

class DataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $sensorsWithoutAmbient = DataTransfer::getSensorsWithoutAmbient();
        $sensorsNotRegistered = DataTransfer::getLastUnregisteredSensorScans();
        view()->share(['sensorsWithoutAmbient' => $sensorsWithoutAmbient,
                       'sensorsNotRegistered' => $sensorsNotRegistered]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\DataTransfer', function(){
            return new DataTransfer();
        });
    }
}
