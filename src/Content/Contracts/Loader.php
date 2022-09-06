<?php

namespace Macrame\Content\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface Loader extends Arrayable
{
    /**
     * Load the data.
     *
     * @return void
     */
    public function load();
}
