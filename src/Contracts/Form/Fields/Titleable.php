<?php

namespace Macrame\Contracts\Form\Fields;

interface Titleable
{
    /**
     * Set field title.
     *
     * @param  string  $title
     * @return $this
     */
    public function title($title);

    /**
     * Set field title html tag.
     *
     * @param  string  $tag
     * @return $this
     */
    public function titleTag($tag);

    /**
     * Determine wether the field has a title.
     *
     * @param  bool  $hasTitle
     * @return bool
     */
    public function hasTitle(bool $hasTitle);
}
