<?php

namespace Ethereal\Support\Facade;

class App extends Facade
{
    public static function getFacadeAccessorName(): string
    {
        return 'app';
    }
}