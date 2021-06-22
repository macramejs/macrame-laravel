<?php

namespace Macrame\Ui\Table;

use Illuminate\Contracts\Support\Arrayable;

class Schema implements Arrayable
{
    /**
     * Table columns.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Add column.
     *
     * @return Column
     */
    public function col()
    {
        return $this->columns[] = new Column();
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return collect($this->columns)->toArray();
    }
}
