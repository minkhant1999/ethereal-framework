<?php

namespace Ethereal\Support;

class Str
{
    public static function path(string $str, string $index = '')
    {
        return trim($str, '/') ?: $index;
    }

    public static function trim(string $str, string $char = " \t\n\r\0\x0B")
    {
        return trim($str, $char);
    }

    public static function toUpper(string $str)
    {
        return strtoupper($str);
    }

    public static function toLower(string $str)
    {
        return strtolower($str);
    }

    public static function toCapitalize(string $str)
    {
        return ucfirst($str);
    }
}