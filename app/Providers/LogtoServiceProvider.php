<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Logto\Sdk\LogtoClient;
use Logto\Sdk\LogtoConfig;

class LogtoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LogtoClient::class, function ($app) {
            $config = $app['config']->get('logto');
            
            return new LogtoClient(
                new LogtoConfig(
                    endpoint: $config['endpoint'],
                    appId: $config['app_id'],
                    appSecret: $config['app_secret'],
                    scopes: $config['scopes'],
                    resources: $config['resources'],
                )
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
