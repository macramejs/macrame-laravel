<?php

namespace Macrame\Contracts\Form;

use Macrame\Contracts\Ui\Component;

interface Field
{
    /**
     * Get the corresponding component.
     *
     * @return Component
     */
    public function getComponent();

    /**
     * Get the model attributes that are edited by the form field.
     *
     * @return array
     */
    public function attributes();
}
