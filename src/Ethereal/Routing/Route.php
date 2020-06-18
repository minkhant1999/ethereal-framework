<?php

namespace Ethereal\Routing;

use Ethereal\Support\Str;
use Ethereal\Support\Url;

class Route
{
    public $path;

    public $method;

    protected $callback;

    public function __construct(string $method, string $path, $callback)
    {
        $this->path = Url::trim($path);
        $this->method = Str::toUpper($method);
        $this->callback = $callback;
    }

    public function isController()
    {
        return is_string($this->callback);
    }

    public function isCallable()
    {
        return $this->isCallback();
    }

    public function isCallback()
    {
        return is_callable($this->callback);
    }

    public function getController(): array
    {
        return explode('@', $this->callback);
    }

    public function getCallback(): string
    {
        return $this->callback;
    }

    public function execute(array $arguments = [])
    {
        return call_user_func_array($this->getCallback(), $arguments);
    }
}