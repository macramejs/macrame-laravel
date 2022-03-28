<?php

namespace Macrame\Tree\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

trait IsTree
{
    public static function updateOrder($order, $parentId = null)
    {
        foreach ($order as $position => $model) {
            static::whereKey($model['id'])->update([
                'parent_id'    => $parentId,
                'order_column' => $position,
            ]);

            static::updateOrder($model['children'], $model['id']);
        }
    }

    public function isSortable(): bool
    {
        if (property_exists($this, 'sortable')) {
            return $this->sortable;
        }

        return true;
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        $relation = $this->hasMany(static::class, 'parent_id', 'id');

        if ($this->isSortable()) {
            $relation->orderBy('order_column');
        }

        return $relation;
    }

    public static function root(): Collection
    {
        $query = static::whereRoot();

        if ((new static())->isSortable()) {
            $query->orderBy('order_column');
        }

        return $query->get();
    }

    public function scopeWhereRoot($query)
    {
        $query->whereNull('parent_id');
    }
}
