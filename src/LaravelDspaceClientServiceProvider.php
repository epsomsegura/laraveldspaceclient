<?php

namespace Epsomsegura\Laraveldspaceclient;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelDspaceClientServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->offerPublishing();
        $this->loadRoutesFrom(__DIR__ . "/../routes/web.php");
        $this->loadViewsFrom(__DIR__ . '/../views', 'laravel-dspace-client');

        Blade::componentNamespace("Epsomsegura\\Laraveldspaceclient\\Components", 'laravel-dspace-client');
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
        if (!function_exists('config_path') || !function_exists('app_path')) {
            return;
        }
        $this->publishes([
            __DIR__ . '/../config/laravel-dspace-client.php' => config_path('laravel-dspace-client.php'),
            // __DIR__ . '/../app/traits/ManagerTrait.php' => app_path('Traits/ManagerTrait.php'),
        ], 'laravel-dspace-client');
    }
}
