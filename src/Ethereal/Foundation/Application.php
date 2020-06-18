<?php

namespace Ethereal\Foundation;

use Ethereal\Routing\RouteServiceProvider;
use Ethereal\Support\ServiceProvider;

class Application extends Container
{
    /** @var string */
    protected $basePath;

    /** @var string */
    protected $viewPath;

    /** @var boolean */
    protected $hasBeenBooted;

    /** @var \Ethereal\Support\ServiceProvider[] */
    protected $providers = [];

    /** @var object[] */
    protected $instances = [];

    /**
     *  
     * @param  string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->basePath = realpath($basePath) ?: $basePath;
        $this->viewPath = $this->basePath('views');
        $this->registerBaseServiceProviders();
    }

    protected function registerBaseServiceProviders()
    {
        $this->register(new RouteServiceProvider($this));
    }

    public function register(ServiceProvider $provider)
    {
        $this->providers[] = $provider;
        $provider->registered();
    }

    /**
     *  
     * @return void
     */
    public function boot()
    {
        if ($this->hasBeenBooted || !$this->providers) {
            return;
        }

        foreach ($this->providers as $provider) {
            $provider->booted();
        }

        unset($this->providers);

        $this->hasBeenBooted = true;
    }

    /**
     *  
     * @param  string $path
     * @return string
     */
    public function basePath(string $path = '')
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     *  
     * @param  string $path
     * @return string
     */
    public function viewPath(string $path = '')
    {
        return $this->viewPath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    public function instance(string $name, object $instance = null): object
    {
        if ($instance === null) {
            return $this->instances[$name];
        }
        return $this->instances[$name] = $instance;
    }
}