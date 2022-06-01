<?php

namespace Macrame\Content\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface Parser extends Arrayable
{
    /**
     * Parse the repeatable.
     *
     * @return void
     */
    public function parse();
}
