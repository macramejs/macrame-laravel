<?php

namespace Macrame\Contracts\Tree;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

interface Tree
{
    public function isSortable(): bool;

    public function parent(): BelongsTo;

    public function children(): HasMany;

    public function root(): Collection;
}
