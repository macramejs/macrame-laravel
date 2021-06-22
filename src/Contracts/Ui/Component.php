<?php

namespace Macrame\Contracts\Ui;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface Component extends Arrayable, Jsonable
{
    /**
     * Add a prop to the component.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function prop($name, $value);

    /**
     * Bind multiple props.
     *
     * @param  array $props
     * @return $this
     */
    public function bind($props);

    /**
     * Set component name.
     *
     * @param  string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get component props.
     *
     * @return array
     */
    public function getProps();
}
