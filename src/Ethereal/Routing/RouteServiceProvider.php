<?php

namespace Ethereal\Routing;

use Ethereal\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $router;

    public function register()
    {
        $this->router = $this->app->instance('route', new Router);
    }

    public function boot()
    {
        $this->router->load($this->app->basePath('routes.php'));
    }
}