<?php
namespace GlobalStudio\University;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class UniversityServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'university');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

    }

    public function register()
    {
        
    }
}
