<?php

namespace Macrame\Form\Fields;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Macrame\Form\Field;

class BelongsToSelect extends Field
{
    /**
     * The ui component name that represents the field.
     *
     * @var string
     */
    protected $componentName = 'lit-relation-belongs-to-select';

    /**
     * The relationship instance.
     *
     * @var \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $relation;

    /**
     * The route to fetch the items that can be attached.
     *
     * @var string
     */
    protected $indexRoute;

    /**
     * The value that is displayed in the select.
     *
     * @var string
     */
    protected $value;

    /**
     * Create new BelongsToSelect instance.
     *
     * @param  BelongsTo  $relation
     * @param  string  $indexRoute
     * @return void
     */
    public function __construct(BelongsTo $relation, $indexRoute)
    {
        $this->relation = $relation;
        $this->indexRoute = $indexRoute;

        parent::__construct($relation->getForeignKeyName());
    }

    /**
     * Mount the field.
     *
     * @param  \Macrame\Contracts\Ui\Component  $component
     * @return void
     */
    public function mount($component)
    {
        $component
            ->prop('index-route', $this->indexRoute)
            ->prop('owner-key', $this->relation->getOwnerKeyName())
            ->prop('value', $this->value);
    }

    /**
     * Set the value that is being displayed in the select field.
     *
     * @param  string  $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }
}
