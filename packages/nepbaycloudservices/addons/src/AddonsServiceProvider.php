<?php

namespace Nepbaycloudservices\Addons;

use Illuminate\Support\ServiceProvider;

class AddonsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {        
        $this->loadViewsFrom(__DIR__.'/Views', 'addons');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'addons');
        //$this->loadMigrationsFrom(__DIR__.'/Migrations'); 
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('addons',function(){
            return new Addons();
        });  
    }
}
