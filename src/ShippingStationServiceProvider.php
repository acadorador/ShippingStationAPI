<?php

namespace ShippingStation;

use Illuminate\Support\ServiceProvider;

class ShippingStationServiceProvider extends ServiceProvider 
{
    /**
     * Config path
     * @return string
     */
    protected function configPath()
    {
        return __DIR__ . '/config/shippingstation.php';
    }

    /**
     * Register the application services
     * 
     * return @void
     */
    public function register() {
        if($this->app->config->get('shippingstation') === null) {
            $this->app->config->set('shippingstation',require $this->configPath());
        }

        $this->app->singleton(ShippingStation::class, function($app) {
            $config = $app->config->get('shippingstation', []);
            return new ShippingStation($config);
        });

        $this->app->alias(ShippingStation::class,'shippingstation');
    }

    /**
     * Boot method
     */
    public function boot() {
        $this->publishes([
            $this->configPath() => config_path('shippingstation')
        ]);
    }
}