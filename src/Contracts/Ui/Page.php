<?php

namespace Macrame\Contracts\Ui;

use Macrame\Contracts\Form\Form;

interface Page
{
    /**
     * Add data to the page.
     *
     * @param  string  $attribute
     * @param  mixed  $data
     * @return $this
     */
    public function with($attribute, $data = null);

    /**
     * Add the given form to the page.
     *
     * @param  Form  $form
     * @param  string  $route
     * @param  bool  $create
     * @return $this
     */
    public function form(Form $form, $route, $create = false);

    /**
     * Render the page.
     *
     * @return \Inertia\Response
     */
    public function render();
}
