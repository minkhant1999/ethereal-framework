<?php

namespace Ethereal\Support;

class Url
{
    public static function trim(string $path, string $index = '')
    {
        return rtrim($path, '/') ?: $index;
    }
}