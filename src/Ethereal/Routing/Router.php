<?php

namespace Ethereal\Routing;

class Router
{
    protected $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function load(string $file)
    {
        require $file;
    }

    public function any($path, $callback)
    {
        $this->get($path, $callback);
        $this->post($path, $callback);
        $this->patch($path, $callback);
        $this->put($path, $callback);
        $this->delete($path, $callback);
        $this->options($path, $callback);
    }

    public function get($path, $callback)
    {
        $this->routes[] = new Route(__FUNCTION__, $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->routes[] = new Route(__FUNCTION__, $path, $callback);
    }

    public function put($path, $callback)
    {
        $this->routes[] = new Route(__FUNCTION__, $path, $callback);
    }

    public function patch($path, $callback)
    {
        $this->routes[] = new Route(__FUNCTION__, $path, $callback);
    }

    public function delete($path, $callback)
    {
        $this->routes[] = new Route(__FUNCTION__, $path, $callback);
    }

    public function options($path, $callback)
    {
        $this->routes[] = new Route(__FUNCTION__, $path, $callback);
    }
}