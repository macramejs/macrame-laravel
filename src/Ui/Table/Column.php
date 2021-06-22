<?php

namespace Macrame\Ui\Table;

use Illuminate\Contracts\Support\Arrayable;

class Column implements Arrayable
{
    /**
     * Column label.
     *
     * @var string
     */
    protected $label;

    /**
     * Column value.
     *
     * @var string
     */
    protected $value;

    /**
     * Set column label.
     *
     * @param string $label
     * @return $this
     */
    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set column value.
     *
     * @param string $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'label' => $this->label,
            'value' => $this->value,
        ];
    }
}
