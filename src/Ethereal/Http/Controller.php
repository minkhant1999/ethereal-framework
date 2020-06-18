<?php

namespace Ethereal\Http;

use Ethereal\Foundation\Application;

abstract class Controller
{
    const SEPARATOR = '\\';

    /**
     * @var \Ethereal]Foundation]Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}