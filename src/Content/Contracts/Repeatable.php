<?php

namespace Macrame\Content\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface Repeatable extends Arrayable
{
    public function parse();
}
