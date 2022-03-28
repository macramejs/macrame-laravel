<?php

namespace Macrame\Contracts\Ui;

use Illuminate\Contracts\Support\Responsable;

interface Page extends Responsable
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
     * Render the page.
     *
     * @return \Inertia\Response
     */
    public function render();
}
