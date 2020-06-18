<?php

namespace Ethereal\Foundation\Http;

use Exception;
use Ethereal\Support\Arr;
use Ethereal\Http\Request;
use BadMethodCallException;
use Ethereal\Foundation\Application;
use Ethereal\Http\Controller;
use Ethereal\Http\Response;

class Kernel
{
    protected $app;

    protected $allow_methods = [
        'GET', 'POST', 'PATCH', 'PUT', 'DELETE', 'OPTIONS'
    ];

    protected $deny_methods = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->boot();
    }

    protected function boot()
    {
        $this->allow_methods = Arr::diff($this->allow_methods, $this->deny_methods);
        unset($this->deny_methods);

        $this->app->boot();
    }

    public function handle(Request $request)
    {
        $path = $request->path();
        $method = $request->method();

        if (!$this->isAllowed($method)) {
            throw new BadMethodCallException(
                sprintf('Method [%s] is not allowed, expected as [%s]', $method, Arr::join(', ', $this->allow_methods))
            );
        }

        $routes = $this->route($path, $method);
        $route = $routes[0];

        if ($route->isCallable()) {
            $response = $route->execute();

            return new Response($response);
        }

        [$controller, $method] = $route->getController();
        $controller = $this->getControllerName($controller);

        $controller = new $controller($this->app);
        $response = $controller->$method();

        return new Response($response);
    }

    protected function route(string $path, string $method)
    {
        $routes = $this->app
            ->instance('route')
            ->getRoutes()
            ->where('path', '=', $path)
            ->where('method', '=', $method);

        $route = $routes->resolve();

        if (!count($route)) {
            throw new Exception(
                sprintf('%s - Route [%s] not found', $method, $path)
            );
        }

        return $route;
    }

    public function getControllerName(string $name)
    {
        return Arr::join(Controller::SEPARATOR, ['', $name]);
    }

    public function isAllowed(string $method)
    {
        return in_array($method, $this->allow_methods);
    }
}