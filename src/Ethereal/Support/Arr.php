<?php

namespace Ethereal\Support;

class Arr
{
    public static function isAssoc($input)
    {
        if (!is_array($input)) {
            return false;
        }
        $keys = array_keys($input);
        return $keys !== array_keys($keys);
    }

    public static function join(string $glue, array $arr)
    {
        return implode($glue, $arr);
    }

    public static function divide(array $arr)
    {
        return [array_keys($arr), array_values($arr)];
    }

    public static function column(array $arr, string $column, int $index = null)
    {
        return array_column($arr, $column, $index);
    }

    public static function replace(array $arr1, array $arr2)
    {
        return array_replace($arr1, $arr2);
    }

    public static function diff(array $arr1, array ...$arrN)
    {
        return array_diff($arr1, ...$arrN);
    }

    public static function push(array &$arr, $value, ...$values)
    {
        return array_push($arr, $value, ...$values);
    }

    public static function pop(array &$arr)
    {
        return array_pop($arr);
    }

    public static function reverse(array $arr, $options = null)
    {
        return array_reverse($arr, $options);
    }

    public static function sort(array &$arr, $options = null)
    {
        return sort($arr, $options);
    }

    public static function map($input1, $input2)
    {
        $arr = is_array($input1) ? $input1 : $input2;
        $cb = is_callable($input2) ? $input2 : $input1;
        return array_map($cb, $arr);
    }

    public static function filter($input1, $input2)
    {
        $arr = is_array($input1) ? $input1 : $input2;
        $cb = is_callable($input2) ? $input2 : $input1;
        return array_filter($arr, $cb);
    }
}