<?php

namespace Macrame\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Macrame\Contracts\Table\Table as TableContract;
use Macrame\Table\Filter\Schema as FilterSchema;

abstract class Table implements TableContract
{
    /**
     * Table schema.
     *
     * @var Schema
     */
    protected $schema;

    /**
     * Default number of items per page.
     *
     * @var int
     */
    protected $defaultPerPage = 10;

    /**
     * The table filters.
     *
     * @var FilterSchema|null
     */
    protected $filters;

    /**
     * Indicates wether the url should be synchronised.
     *
     * @var bool
     */
    protected $syncUrl = false;

    /**
     * Table ui component name.
     *
     * @var string
     */
    protected $componentName = 'ui-index';

    /**
     * Get table schema.
     *
     * @param  \Macrame\Table\Schema $form
     * @return void
     */
    public function schema(Schema $form)
    {
        //
    }

    /**
     * Get filter schema.
     *
     * @param  \Macrame\Table\Filters\Schema $filter
     * @return void
     */
    public function filters($filter)
    {
        //
    }

    /**
     * Retrieve table items.
     *
     * @param  \Illuminate\Http\Request                           $request
     * @param  \Illuminate\Database\Eloquent\Builder              $builder
     * @param  string                                             $resource
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function items(Request $request, $builder, $resource = JsonResource::class)
    {
        if ($this->hasSearch()) {
            call_user_func_array([$this, 'search'], [$builder, $request->search]);
        }

        $items = $builder->paginate($this->defaultPerPage);

        return $resource::collection($items);
    }

    /**
     * Get wrapper ui component instance.
     *
     * @return \Ignite\Contracts\Ui\Component
     */
    public function getComponent()
    {
        return component($this->componentName, [
            'syncUrl'        => $this->syncUrl,
            'defaultPerPage' => $this->defaultPerPage,
            'hasSearch'      => $this->hasSearch(),
            'filters'        => $this->getFilters()->toArray(),
            'schema'         => $this->getSchema()->toArray(),
        ]);
    }

    /**
     * Determine wether the table is a searchable.
     *
     * @return bool
     */
    public function hasSearch()
    {
        return method_exists($this, 'search');
    }

    /**
     * Set the route where the items should be loaded from.
     *
     * @param  string $route
     * @return $this
     */
    public function from($route)
    {
        $this->component->prop('route', $route);

        return $this;
    }

    /**
     * Set wether the table parameters such as search, filters and pagination
     * should be synched to url parameters.
     *
     * @param  bool  $sync
     * @return $this
     */
    public function syncUrl(bool $sync = true)
    {
        // IDEA: sync multiple urls using a unique key, e.g.: posts.
        // posts.page=3&users.page=2
        $this->syncUrl = true;

        return $this;
    }

    /**
     * Get table schema.
     *
     * @return Schema
     */
    public function getSchema()
    {
        if ($this->schema) {
            return $this->schema;
        }

        $this->schema(
            $this->schema = new Schema()
        );

        return $this->schema;
    }

    /**
     * Get filters.
     *
     * @return FilterSchema
     */
    public function getFilters()
    {
        if ($this->filters) {
            return $this->filters;
        }

        $this->filters(
            $this->filters = new FilterSchema($this)
        );

        return $this->filters;
    }

    /**
     * Render the table.
     *
     * @param  string                         $route
     * @return \Ignite\Contracts\Ui\Component
     */
    public function render($route)
    {
        return $this->getComponent()->bind([
            'route' => $route,
        ]);
    }
}
