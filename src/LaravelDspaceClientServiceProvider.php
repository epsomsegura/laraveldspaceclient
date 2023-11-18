<?php

namespace Epsomsegura\Laraveldspaceclient;

use Illuminate\Support\ServiceProvider;

class LaravelDspaceClientServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->offerPublishing();
        $this->loadRoutesFrom(__DIR__ . "/../routes/web.php");
    }
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/laravel-dspace-client.php", "laravel-dspace-client");
    }
    /**
     * 
     */
    protected function offerPublishing(): void
    {
        if (!function_exists('config_path')) {
            return;
        }
        $this->publishes([
            __DIR__ . '/../config/laravel-dspace-client.php' => config_path('laravel-dspace-client.php'),
        ], 'laravel-dspace-client');
    }
}
