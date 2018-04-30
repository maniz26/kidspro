<?php

namespace Nepbaycloudservices\Backendcp;

use Illuminate\Support\ServiceProvider;

class BackendCpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->loadViewsFrom(__DIR__.'/Views', 'backendcp');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'backendcp');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');          
        $this->registerHelpers();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       

        $this->app->bind('backendcp',function(){
            return new Backendcp();
        });


        
    }

    public function registerHelpers()
    {       
        if (file_exists($file = __DIR__ . '/Helpers/helper.php') )
        {   
            require $file;
        }
    }
}
