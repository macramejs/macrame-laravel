<?php

namespace Macrame\Form;

use Macrame\Contracts\Form\Field as FieldContract;
use Macrame\Contracts\Ui\Component;

abstract class Field implements FieldContract
{
    /**
     * The attribute name that is being edited by the field.
     *
     * @var string
     */
    protected $attribute;

    /**
     * The parent form instance that the field is bound to.
     *
     * @var \Macrame\Contracts\Form\Form|null
     */
    protected $form;

    /**
     * The ui component name that represents the field.
     *
     * @var string|null
     */
    protected $componentName;

    /**
     * Create new field instance.
     *
     * @param  string  $attribute
     */
    public function __construct($attribute)
    {
        $this->attribute = $attribute;
        $this->title = ucfirst(str_replace('_', ' ', $attribute));
    }

    /**
     * Mount the field.
     *
     * @param  \Macrame\Contracts\Ui\Component  $component
     * @return void
     */
    public function mount($component)
    {
        //
    }

    /**
     * Bind the field to the given form.
     *
     * @param  Form  $form
     * @return void
     */
    public function bind(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Get the ui component that represents the form.
     *
     * @return \Macrame\Contracts\Ui\Component
     */
    public function getComponent()
    {
        $component = component($this->componentName, [
            'attribute' => $this->attribute,
        ]);

        $this->mountTraits($component);

        $this->mount($component);

        return $component;
    }

    /**
     * Call mount mehtodes of traits.
     *
     * @param  \Macrame\Contracts\Ui\Component  $component
     * @return void
     */
    protected function mountTraits(Component $component)
    {
        $traits = array_values(class_uses_recursive($this));

        foreach ($traits as $trait) {
            $method = 'mount'.class_basename($trait);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], [$component]);
            }
        }
    }

    /**
     * Get the attributes that are being edited by the field.
     *
     * @return array
     */
    public function attributes()
    {
        return [$this->attribute];
    }
}
