<?php

namespace Korko\CallR;

use Illuminate\Support\ServiceProvider;

/**
 * CallR Service provider for Laravel
 *
 * @author Jeremy Lemesle <jeremy.lemesle@korko.fr>
 */
class CallRServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/callr.php' => config_path('callr.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CallRClient::class, function ($app) {
            return new CallRClient($app['config']['callr.username'], $app['config']['callr.password'], $app['config']['callr.alias'], $app['config']['callr.sender']);
        });

        $this->commands(CallRSmsCommand::class);
    }
}
