<?php

namespace Flamix\Apps24LaravelLead;

use Illuminate\Routing\Router;
use Flamix\Bitrix24\Lead;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lead24.php', 'lead24');

        $this->app->singleton('lead24', function ($app) {
            return Lead::getInstance()->changeSubDomain(config('lead24.subdomain'))->auth(config('lead24.portal'), config('lead24.api'));
        });
    }

    public function boot(Router $router): void
    {
        $this->publishes([__DIR__ . '/../config/lead24.php' => config_path('lead24.php')], 'config');

        // Create middleware and add it to the web group
        $router->aliasMiddleware('utm', \Flamix\Apps24LaravelLead\Middleware\UTM::class);
        $this->app->booted(function () use ($router) {
            $router->pushMiddlewareToGroup('web', 'utm');
        });
    }
}
