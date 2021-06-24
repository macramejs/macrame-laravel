<?php

namespace Macrame\Table\Filter;

use Closure;
use Illuminate\Support\Str;

class Filter
{
    /**
     * Handler.
     *
     * @var Closure|string|array
     */
    protected $handler;

    /**
     * Create new Filter instance.
     *
     * @param  Closure|string|array          $handler
     * @return \Macrame\Table\Filters\Filter
     */
    public function __construct($handler)
    {
        $this->handler = $handler;
    }

    /**
     * Apply filter attributes to the query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  array                                 $attributes
     * @return void
     */
    public function apply($builder, $attributes)
    {
        if ($this->handler instanceof Closure) {
            return call_user_func($this->handler, $builder, $attributes);
        }

        [$handler, $method] = Str::parseCallback($this->handler);

        if (is_string($handler)) {
            $handler = app()->make($handler);
        }

        return $handler->{$method}($builder, $attributes);
    }
}
