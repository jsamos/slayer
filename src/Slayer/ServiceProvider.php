<?php namespace Slayer;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Config;

class ServiceProvider extends BaseServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('jsamos/slayer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app['slayer-factory'] = $this->app->share(function($app)
        {

            $config = Config::get('services');
            return Factory::init($config);

        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('slayer-factory');
    }

}