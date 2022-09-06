<?php

namespace Macrame\Content;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Macrame\Content\Contracts\Loader;

abstract class TemplateCast implements CastsAttributes
{
    /**
     * Create new PageContent instance.
     *
     * @param  Model|null  $model
     * @param  string  $template
     * @return void
     */
    public function __construct(
        protected ?Model $model = null,
        protected ?string $template = '',
    ) {
        //
    }

    /**
     * Get the data of the associated template.
     *
     * @return Loader
     */
    public function data(): array|Loader
    {
        $parsers = $this->getParsers();

        if (! array_key_exists($this->template, $parsers)) {
            return [];
        }

        $instance = $this->getLoaderInstance($parsers[$this->template]);

        $instance->load();

        return $instance;
    }

    /**
     * Get the instance of the given loader class.
     *
     * @param  string  $loader
     * @return Loader
     */
    public function getLoaderInstance($loader): Loader
    {
        return new $loader($this->model);
    }

    /**
     * Get a list of parsers.
     *
     * @return array
     */
    protected function getParsers()
    {
        return $this->parsers;
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
        return new static($model, $value);
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
            return $value->__toString();
        }

        return $value;
    }

    /**
     * Get the instance as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->template;
    }
}
