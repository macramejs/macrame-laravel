<?php

namespace Macrame\Contracts\Form;

interface Form
{
    /**
     * Render the form.
     *
     * @param  string  $route
     * @param  bool  $create
     * @return array
     */
    public function render($route, $create = false);
}
