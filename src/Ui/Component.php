<?php

namespace Macrame\Ui;

use Illuminate\Contracts\Support\Arrayable;
use Macrame\Contracts\Ui\Component as ComponentContract;

class Component implements ComponentContract
{
    /**
     * Component props.
     *
     * @var array
     */
    protected $props = [];

    /**
     * Component name.
     *
     * @var string
     */
    public $name;

    /**
     * Create new Component instance.
     *
     * @param  string  $name
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Set component name.
     *
     * @param  string  $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Bind multiple component props.
     *
     * @param  array  $props
     * @return $this
     */
    public function bind($props)
    {
        foreach ($props as $name => $value) {
            $this->props[$name] = $value;
        }

        return $this;
    }

    /**
     * Bind prop to the component.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return $this
     */
    public function prop($name, $value)
    {
        $this->props[$name] = $value;

        return $this;
    }

    /**
     * Get component properties.
     *
     * @return array
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * Get component prop by name.
     *
     * @param  string  $name
     * @return mixed
     */
    public function getProp($name)
    {
        return $this->props[$name] ?? null;
    }

    /**
     * Get component name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->renderArray([
            'props' => $this->props,
            'name' => $this->name,
        ]);
    }

    /**
     * Render array.
     *
     * @param  array  $array
     * @return array
     */
    protected function renderArray(array $array): array
    {
        return collect($array)->map(function ($value) {
            if ($value instanceof Arrayable) {
                return $value->toArray();
            }

            if (is_array($value)) {
                return $this->renderArray($value);
            }

            return $value;
        })->toArray();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
