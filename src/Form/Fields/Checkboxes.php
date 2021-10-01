<?php

namespace Macrame\Form\Fields;

use Macrame\Contracts\Form\Fields\Titleable;
use Macrame\Form\Field;

class Checkboxes extends Field implements Titleable
{
    use Traits\HasTitle;

    /**
     * Checkbox options.
     *
     * @var array
     */
    public $options = [];

    /**
     * The ui component name that represents the field.
     *
     * @var string
     */
    protected $componentName = 'ui-form-checkboxes';

    /**
     * The input component name.
     *
     * @var string
     */
    protected $checkboxComponentName = 'ui-checkbox';

    /**
     * Create new Checkboxes instance.
     *
     * @param  string  $attribute
     * @param  array  $options
     */
    public function __construct($attribute, $options)
    {
        parent::__construct($attribute);
        $this->options = $options;
    }

    /**
     * Mount the field.
     *
     * @param  \Macrame\Contracts\Ui\Component  $component
     * @return void
     */
    public function mount($component)
    {
        $component->bind([
            'checkboxComponent' => component($this->checkboxComponentName),
            'options'           => $this->options,
        ]);
    }
}
