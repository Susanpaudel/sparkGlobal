<?php
namespace Globalstudio\Login;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class LoginServiceProvider extends ServiceProvider
{
    public function boot()
    {
      
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'login');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([
            __DIR__ . '/public' => public_path('login'),
        ], 'public');
    }

    public function register()
    {
        
    }
}   
