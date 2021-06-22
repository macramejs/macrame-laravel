<?php

namespace Macrame\Form;

use Macrame\Contracts\Form\Field;
use Macrame\Contracts\Ui\Component;

class Schema
{
    /**
     * Form fields.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * A list of ui components that represent the form.
     *
     * @var array
     */
    protected $components = [];

    /**
     * Add an array of fields.
     *
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        foreach ($fields as $field) {
            $this->field($field);
        }

        return $this;
    }

    /**
     * Add a file.d.
     *
     * @param Field $field
     * @return $this
     */
    public function field(Field $field)
    {
        $this->fields[] = $field;
        $this->components[] = $field->getComponent();

        return $this;
    }

    /**
     * Bind the form to the given component.
     *
     * @param \Macrame\Contracts\Ui\Component $component
     * @return void
     */
    public function bindTo(Component $component)
    {
        $component
            ->prop('attributes', collect($this->fields)->map(fn ($field) => $field->attributes())->flatten()->toArray())
            ->prop('schema', collect($this->components)->toArray());
    }
}
