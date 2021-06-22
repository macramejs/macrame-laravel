<?php

if (! function_exists('component')) {
    /**
     * Create a component.
     *
     * @param  string                               $name
     * @param  array                                $props
     * @return \Macrame\Contracts\Ui\Component|mixed
     */
    function component($name, $props = [])
    {
        return (new Macrame\Ui\Component($name))->bind($props);
    }
}
