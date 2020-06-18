<?php

namespace Ethereal\Support;

use ArrayAccess;
use Countable;
use OutOfRangeException;
use UnexpectedValueException;

class Collection implements Countable, ArrayAccess
{
    protected $matches = [];

    protected $items = [];

    public function __construct(array $items = [])
    {
        foreach ($items as $name => $item) {
            $this->{$name} = $item;
        }
    }

    public function all()
    {
        return new static($this->items);
    }

    public function where(string $column, string $operator, $excepted)
    {
        $this->matches[] = [$column, $operator, $excepted];

        return $this;
    }

    public function resolve(int $index = null)
    {
        $items = $this->items;

        foreach ($this->matches as $matched) {
            [$column, $operator, $excepted] = $matched;
            $this->match(
                Arr::column($items, $column, $index),
                $operator,
                $excepted
            );
            var_dump($items);
        }

        $this->matches = [];

        return new static($items);
    }

    public function match(string $value, $operator, $excepted)
    {
        switch ($operator):
            case '=':
                return $value === $excepted;

            case '>':
                return $value > $excepted;

            case '<':
                return $value < $excepted;

            case '>=':
                return $value >= $excepted;

            case '<=':
                return $value <= $excepted;

            case '!=':
                return $value !== $excepted;

            case '<=>':
                return $value <=> $excepted;

            default:
                throw new OutOfRangeException(
                    sprintf('Unexcepted operator [%s] could not be resolved', $operator)
                );
        endswitch;
    }

    /**
     * 
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * 
     * @return mixed
     */
    public function offsetGet($name)
    {
        return $this->items[$name];
    }

    /**
     * 
     * @return bool
     */
    public function offsetExists($name)
    {
        return array_key_exists($name, $this->items);
    }

    /**
     * 
     * @return mixed
     */
    public function offsetSet($name, $value)
    {
        if (is_array($value)) {
            $value = new static($value);
        }

        if (empty($name)) {
            return $this->items[] = $value;
        }

        return $this->items[$name] = $value;
    }

    /**
     * 
     * @return void
     */
    public function offsetUnset($name)
    {
        unset($this->items[$name]);
    }

    /**
     * 
     * @return string
     */
    public function json(int $options = JSON_PRETTY_PRINT)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * 
     * @return array
     */
    public function __debugInfo()
    {
        return $this->toArray();
    }

    /**
     * 
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->json();
    }

    /**
     * 
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * 
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->offsetSet($name, $value);
    }
}