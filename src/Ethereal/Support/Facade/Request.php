<?php

namespace Ethereal\Support\Facade;

class Request extends Facade
{
    public static function getFacadeAccessorName(): string
    {
        return 'request';
    }
}