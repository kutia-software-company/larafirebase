<?php

namespace Kutia\Larafirebase\Providers;

use Illuminate\Support\ServiceProvider;

class LarafirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__. '../../Config/larafirebase.php',
            'larafirebase'
        );
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__. '/../Config/larafirebase.php' => config_path('larafirebase.php'),
        ]);
    }
}
