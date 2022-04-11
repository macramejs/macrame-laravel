<?php

namespace Macrame\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

abstract class ContentCast implements CastsAttributes, Arrayable, Jsonable
{
    /**
     * Parse items.
     *
     * @param array $items
     * @return $this
     */
    abstract public function parse();

    /**
     * Create new PageContent instance.
     *
     * @param array $data
     */
    public function __construct(
        protected ?Model $model = null,
        protected array $items = []
    ) {
        //
    }

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $items = json_decode($value, true);

        return new static($model, $items);
    }

    /**
     * Get the items.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get array from resource and model.
     *
     * @param string $resource
     * @param Model $model
     * @return array
     */
    protected function resourceArray($resource, $model)
    {
        return (new $resource($model))->toArray(request());
    }

    /**
     * Get array from resource and model.
     *
     * @param string $resource
     * @param Model $model
     * @return array
     */
    protected function resourceCollectionArray($resource, $model)
    {
        return $resource::collection()->toArray(request());
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof $this) {
            return $value->toJson();
        }
        
        return json_encode($value, 0);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->items, $options);
    }
}
