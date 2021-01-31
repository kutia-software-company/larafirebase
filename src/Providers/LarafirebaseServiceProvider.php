<?php

namespace Kutia\Larafirebase\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use Kutia\Larafirebase\Services\Larafirebase;
use Kutia\Larafirebase\Channels\FirebaseChannel;

class LarafirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $this->app->make(ChannelManager::class)->extend('firebase', function () use ($app) {
            return $app->make(FirebaseChannel::class);
        });

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

        $this->app->bind('larafirebase', Larafirebase::class);
    }
}
