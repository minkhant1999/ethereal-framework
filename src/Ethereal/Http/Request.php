<?php

namespace Ethereal\Http;

use Ethereal\Support\Arr;
use Ethereal\Support\Str;
use Ethereal\Support\Url;

class Request
{
    protected $server;

    public function __construct(array $server)
    {
        $this->server = $server;
    }

    public function method()
    {
        return Str::toUpper($this->server['REQUEST_METHOD']);
    }

    public function uri()
    {
        return $this->server['REQUEST_URI'];
    }

    public function path(string $index = '')
    {
        return Url::trim($this->server['REQUEST_URI'], $index);
    }

    public static function create()
    {
        $server = Arr::replace([
            'REQUEST_URI' => null,
            'REQUEST_METHOD' => null,
        ], $_SERVER);

        return new self($server);
    }
}