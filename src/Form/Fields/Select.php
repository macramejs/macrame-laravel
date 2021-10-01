<?php

namespace Macrame\Form\Fields;

use Macrame\Contracts\Form\Fields\Titleable;
use Macrame\Form\Field;

class Select extends Field implements Titleable
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
    protected $componentName = 'ui-form-select';

    /**
     * The select component name.
     *
     * @var string
     */
    protected $selectComponentName = 'ui-select';

    /**
     * Create new Select instance.
     *
     * @param  string  $attribute
     * @param  array  $options
     * @return void
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
            'selectComponent' => $this->getSelectComponent(),
        ]);
    }

    /**
     * Get select component.
     *
     * @return \Macrame\Contracts\Ui\Component
     */
    protected function getSelectComponent()
    {
        return component($this->selectComponentName)->bind([
            'options' => $this->options,
        ]);
    }
}
