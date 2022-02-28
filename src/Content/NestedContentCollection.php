<?php

namespace Macrame\Content;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class NestedContentCollection extends Collection
{
    /**
     * Create new Content instance.
     *
     * @param  array  $items
     * @param  Model|mixed  $model
     */
    public function __construct(
        protected mixed $model,
        $items = []
    ) {
        parent::__construct($items);
    }

    /**
     * Parse the items.
     *
     * @param  array  $resources
     * @return $this
     */
    public function parse($resources = [])
    {
        $assets = $this->loadAssets();

        $this->handleRecursive($this->items, function (&$value) use ($assets, $resources) {
            $this->parseValue($value, $assets, $resources);
        });

        return $this;
    }

    /**
     * Load the required assets.
     *
     * @return array
     */
    protected function loadAssets()
    {
        $assets = [];

        $this->handleRecursive(clone $this->items, function ($value) use (&$assets) {
            if (! is_string($value)) {
                return;
            }

            foreach ($this->parseAssets($value) as $key => $value) {
                if (! array_key_exists($key, $assets)) {
                    $assets[$key] = [];
                }

                if (is_array($value)) {
                    $assets[$key] = array_merge($assets[$key], $value);
                } else {
                    $assets[$key] = array_merge($assets[$key], [$value]);
                }
            }
        });

        foreach ($assets as $name => $keys) {
            $assets[$name] = $this->model
                ->{"{$name}Query"}()
                ->whereKeyIn($keys)
                ->get();
        }

        return $assets;
    }

    /**
     * Handle the given items recursively.
     *
     * @param  array  $items
     * @param  Closure  $closure
     * @return void
     */
    protected function handleRecursive(array &$items, Closure $closure)
    {
        foreach ($items as &$item) {
            if (! is_array($item)) {
                continue;
            }

            if (array_keys($item) === range(0, count($item) - 1)) {
                $this->handleRecursive($item, $closure);
            } elseif (array_key_exists('value', $item)) {
                $this->handleRecursive($item['value'], $closure);
                $closure($item['value']);
            }
        }
    }

    /**
     * Parse the given value.
     *
     * @param  mixed  $value
     * @return void
     */
    protected function parseValue(mixed &$value, $assets = [], $resources = [])
    {
        $url = parse_url($value);

        if (($url['scheme'] ?? null) != 'relation') {
            return;
        }

        $type = $url['user'] ?? null;
        $keys = $url['host'] ?? null;

        if (! $type || ! $keys) {
            return;
        }

        $isMany = str_contains($keys, ',');

        if (! array_key_exists($type, $assets) || ! $assets[$type] instanceof Collection) {
            $value = null;

            return;
        }

        if ($isMany) {
            $value = $assets[$type]->whereIn('key', explode(',', $keys));
        } else {
            $value = $assets[$type]->whereIn('key', $keys)->first();
        }
    }

    /**
     * Parse assets.
     *
     * @param  string  $value
     * @return array
     */
    protected function parseAssets(string &$value): array
    {
        $url = parse_url($value);

        if (($url['scheme'] ?? null) != 'relation') {
            return [];
        }

        if ($type = $url['user'] ?? null && $keys = $url['host'] ?? null) {
            return [$type => explode($keys, ',')];
        }

        return [];
    }
}
