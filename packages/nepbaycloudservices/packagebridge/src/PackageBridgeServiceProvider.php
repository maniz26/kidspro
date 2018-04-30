<?php namespace Nepbaycloudservices\PackageBridge;

use Illuminate\Support\ServiceProvider;

class PackageBridgeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->loadRoutesFrom(__DIR__.'/routes.php');        
        $this->publishes([__DIR__.'/config/packagebridge.php' => config_path('packagebridge.php')], 'config');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('packagebridge',function(){
            return new PackageBridge();
        }); 

        $config = app('config')->all();
        $this->app->singleton('config', function ($app) use ($config) {
            return new Repository($config, new Rewrite(), $app['path.config']);
        });
    }
}
