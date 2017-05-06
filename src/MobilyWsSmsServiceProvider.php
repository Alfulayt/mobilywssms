<?php

namespace Abdualrhmanio\MobilyWsSms;

use Illuminate\Support\ServiceProvider;

class MobilyWsSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/mobilywssms.php';
        $this->publishes([$configPath => config_path('mobilywssms.php')], 'config');
        $this->mergeConfigFrom($configPath, 'mobilywssms');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mobilywssms', function ($app) {
            $config = isset($app['config']['services']['mobilywssms']) ? $app['config']['services']['mobilywssms'] : null;
            if (is_null($config)) {
                $config = $app['config']['mobilywssms'] ?: $app['config']['mobilywssms::config'];
            }

            $client = new MobilyWsSmsClient($config['Username'], $config['Password'], $config['SenderName']);

            return $client;
        });
    }

    public function provides() {
        return ['mobilywssms'];
    }


}
