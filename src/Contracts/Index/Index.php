<?php

namespace Macrame\Contracts\Index;

use Illuminate\Http\Request;

interface Index
{
    /**
     * Render the table.
     *
     * @param  string  $route
     * @return \Ignite\Contracts\Ui\Component
     */
    public function render($route);

    /**
     * Retrieve table items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  string  $resource
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function items(Request $request, $builder, $resource = JsonResource::class);
}
