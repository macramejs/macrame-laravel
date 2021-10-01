<?php

namespace Macrame\Table\Filter;

use Macrame\Contracts\Support\Schema as SchemaContract;

class Schema implements SchemaContract
{
    /**
     * Registered filters.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Add a filter.
     *
     * @param  string  $name
     * @param  Closure|string|array  $handler
     * @return \Macrame\Table\Filters\Filter
     */
    public function add($name, $handler)
    {
        return $this->filters[$name] = new Filter($handler);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return collect($this->filters)->toArray();
    }
}
