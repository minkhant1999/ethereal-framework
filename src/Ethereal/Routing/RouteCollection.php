<?php

namespace Ethereal\Routing;

use Ethereal\Support\Arr;
use Ethereal\Support\Collection;

class RouteCollection extends Collection
{
    public function resolve(int $index = null)
    {
        $items = $this->items;

        foreach ($this->matches as $match) {
            $results = [];

            foreach ($items as $item) {
                if ($this->match($item->{$match[0]}, $match[1], $match[2])) {
                    $results[] = $item;
                }
            }

            $items = $results;
        }

        $this->matches = [];

        return new static($items);
    }
}