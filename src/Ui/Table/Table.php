<?php

namespace Macrame\Ui\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class Table
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
     * The table.
     *
     * @var array
     */
    protected $filters = [];

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
     * Table ui component name.
     *
     * @var string
     */
    protected $tableComponentName = 'ui-table';

    /**
     * Pagination ui component name.
     *
     * @var string
     */
    protected $searchComponentName = 'ui-index-search';

    /**
     * Pagination ui component name.
     *
     * @var string
     */
    protected $paginationComponentName = 'ui-pagination';

    /**
     * Get table schema.
     *
     * @param  Schema $form
     * @return void
     */
    abstract public function schema(Schema $form);

    /**
     * Get index table items.
     *
     * @param  Request $request
     * @param  Builder $builder
     * @param  string $resource
     * @return ResourceCollection
     */
    public function items(Request $request, Builder $builder, $resource = JsonResource::class)
    {
        $items = $builder
            ->take($this->defaultPerPage)
            ->paginate();

        return $resource::collection($items);
    }

    /**
     * Get wrapper ui component instance.
     *
     * @return \Macrame\Contracts\Ui\Component
     */
    public function getComponent()
    {
        return component($this->componentName, [
            'tableComponent'      => $this->getTableComponent()->toArray(),
            'searchComponent'     => $this->getSearchComponent()->toArray(),
            'paginationComponent' => $this->getPaginationComponent()->toArray(),
            'syncUrl'             => $this->syncUrl,
            'defaultPerPage'      => $this->defaultPerPage,
        ]);
    }

    /**
     * Get table component.
     *
     * @return \Macrame\Contracts\Ui\Component
     */
    public function getTableComponent()
    {
        return component($this->tableComponentName, [
            'schema' => $this->getSchema()->toArray(),
        ]);
    }

    /**
     * Get search component.
     *
     * @return \Macrame\Contracts\Ui\Component
     */
    public function getSearchComponent()
    {
        return component($this->searchComponentName, [

        ]);
    }

    /**
     * Get pagination component.
     *
     * @return \Macrame\Contracts\Ui\Component
     */
    public function getPaginationComponent()
    {
        return component($this->paginationComponentName, [

        ]);
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
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Render the table.
     *
     * @param  string                         $route
     * @return \Macrame\Contracts\Ui\Component
     */
    public function render($route)
    {
        return $this->getComponent()->bind([
            'route' => $route,
        ]);
    }
}
