<?php

namespace Nepbaycloudservices\Plugins;

use Illuminate\Support\ServiceProvider;
use Validator;

class PluginsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->loadViewsFrom(__DIR__.'/Views', 'plugins');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'plugins');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');              
        $this->registerHelpers();

        Validator::extend('recaptcha','Nepbaycloudservices\Plugins\Helpers\ReCaptcha@validate');
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('plugins',function(){
            return new Plugins();
        });
    }

     public function registerHelpers()
    {       
        if (file_exists($file = __DIR__ . '/Helpers/DomflightApi.php') )
        {   
            require $file;
            
        }

        if (file_exists($file = __DIR__ . '/Helpers/packagehelper.php') )
        {   
            require $file;
            
        }
    }
    
}
