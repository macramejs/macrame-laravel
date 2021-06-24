<?php

namespace Macrame\Contracts\Table;

interface Filter
{
    /**
     * Render the table.
     *
     * @param  string                         $route
     * @return \Ignite\Contracts\Ui\Component
     */
    public function render($route);
}
