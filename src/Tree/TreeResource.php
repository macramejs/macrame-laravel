<?php

namespace Macrame\Tree;

use Illuminate\Http\Resources\Json\JsonResource;

class TreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'value' => $this->value($request),
            'children' => $this->children(),
        ];
    }

    public function children()
    {
        return static::collection(
            $this->resource->children->sortBy('order_column')
        );
    }

    public function value($request)
    {
        return parent::toArray($request);
    }
}
