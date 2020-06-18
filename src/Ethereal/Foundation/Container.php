<?php

namespace Ethereal\Foundation;

use OutOfBoundsException;

class Container
{
    protected $bindings = [];

    public function has($accessor)
    {
        return array_key_exists($accessor, $this->bindings);
    }

    public function get($accessor)
    {
        if (!$this->has($accessor)) {
            throw new OutOfBoundsException(
                sprintf('Undefined accessor name [%s] does not exist in container', $accessor)
            );
        }
        return $this->bindings[$accessor];
    }

    public function bind($accessor, $concrete)
    {
        $this->bindings[$accessor] = $concrete;
    }
}