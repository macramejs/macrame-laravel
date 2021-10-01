<?php

namespace Macrame\Http;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Index
{
    /**
     * Default number of items per page.
     *
     * @var int
     */
    protected $defaultPerPage = 10;

    /**
     * Create new Index instance.
     *
     * @param  array  $filter
     * @param  array  $searchKeys
     * @return void
     */
    public function __construct(
        protected array $filter = [],
        protected array $searchKeys = []
    ) {
        //
    }

    public function items(Request $request, Builder $query)
    {
        $this->filter($request, $query);

        $this->search($request, $query);

        $items = $this->paginate($request, $query);

        return $items;
    }

    protected function filter(Request $request, $query)
    {
        // TODO:
    }

    protected function search(Request $request, $query)
    {
        // TODO:
    }

    protected function paginate(Request $request, Builder $query): Paginator|CursorPaginator
    {
        return $query->paginate(
            perPage: $request->perPage ?: $this->defaultPerPage,
        );
    }
}
