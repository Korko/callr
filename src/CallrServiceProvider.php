<?php

namespace Korko\Callr;

use Illuminate\Support\ServiceProvider;

/**
 * Callr Service provider for Laravel
 *
 * @author Jeremy Lemesle <jeremy.lemesle@korko.fr>
 */
class CallrServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(
            __DIR__ . '/../config/callr.php', 'callr'
        );

        $this->app->singleton(CallrClient::class, function ($app) {
            return new CallrClient($app['config']['callr.username'], $app['config']['callr.password'], $app['config']['callr.alias'], $app['config']['callr.sender']);
        });

        $this->commands([CallrSmsCommand::class, CallrSubscribeCommand::class, CallrUnsubscribeCommand::class, CallrWebhooksListCommand::class]);
    }
}
