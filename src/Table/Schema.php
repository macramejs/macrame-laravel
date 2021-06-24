<?php

namespace Macrame\Table;

use Macrame\Contracts\Support\Schema as SchemaContract;

class Schema implements SchemaContract
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
