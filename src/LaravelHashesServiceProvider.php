<?php

namespace Imhayatunnabi\LaravelHashes;

use Illuminate\Support\ServiceProvider;

class LaravelHashesServiceProvider extends ServiceProvider
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
        $this->publishes([
            __DIR__.'/../config/laravel-hashes.php' => config_path('laravel-hashes.php'),
        ], 'config');
    }
} 