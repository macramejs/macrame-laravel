<?php

namespace Macrame\Form\Fields\Traits;

use Macrame\Contracts\Ui\Component;

trait HasTitle
{
    /**
     * The field title.
     *
     * @var string
     */
    public $title;

    /**
     * The field title html tag.
     *
     * @var string
     */
    public $titleTag = 'h5';

    /**
     * Wether the field has a title.
     *
     * @var bool
     */
    public bool $hasTitle = true;

    /**
     * Set field title.
     *
     * @param  string  $title
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set field title html tag.
     *
     * @param  string  $tag
     * @return $this
     */
    public function titleTag($tag)
    {
        $this->titleTag = $tag;

        return $this;
    }

    /**
     * Determine wether the field has a title.
     *
     * @param  bool  $hasTitle
     * @return bool
     */
    public function hasTitle(bool $hasTitle)
    {
        $this->hasTitle = $hasTitle;

        return $this;
    }

    /**
     * Call mount mehtodes of traits.
     *
     * @param  \Macrame\Contracts\Ui\Component  $component
     * @return void
     */
    public function mountHasTitle(Component $component)
    {
        $component->bind([
            'title'    => $this->title,
            'hasTitle' => $this->hasTitle,
            'titleTag' => $this->titleTag,
        ]);
    }
}
