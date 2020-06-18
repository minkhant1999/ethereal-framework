<?php

namespace Ethereal\Support;

use Ethereal\Foundation\Application;

abstract class ServiceProvider
{
    protected $app;

    protected $booted;

    protected $registered;

    final public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function registered()
    {
        $this->register();
        $this->registered = true;
    }

    abstract public function register();

    public function boot()
    {
        // 
    }

    public function booted()
    {
        $this->boot();
        $this->booted = true;
    }
}