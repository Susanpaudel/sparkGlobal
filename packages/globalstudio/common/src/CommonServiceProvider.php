<?php
namespace GlobalStudio\Common;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class CommonServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'common');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([
            __DIR__ . '/public' => public_path('common'),
        ], 'public');
    }

    public function register()
    {
        
    }
}
