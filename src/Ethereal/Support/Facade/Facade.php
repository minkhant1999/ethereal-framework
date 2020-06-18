<?php

namespace Ethereal\Support\Facade;

abstract class Facade
{
    protected static function getFacadeInstance(string $accessor): object
    {
        return app()->instance($accessor);
    }

    public function __call($name, $arguments)
    {
        $accessor = static::getFacadeAccessorName();

        return static::getFacadeInstance($accessor)
            ->$name(...$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        $accessor = static::getFacadeAccessorName();

        return static::getFacadeInstance($accessor)
            ->$name(...$arguments);
    }

    abstract public static function getFacadeAccessorName(): string;
}