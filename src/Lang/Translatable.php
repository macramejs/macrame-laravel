<?php

namespace Macrame\Lang;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Translatable implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  string                              $key
     * @param  mixed                               $value
     * @param  array                               $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new MultilangAttribute(
            $model->fromJson($value, asObject: false),
            app()->getLocale()
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  string                              $key
     * @param  mixed                               $value
     * @param  array                               $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof MultilangAttribute) {
            return $value->raw();
        }

        return $value;
    }
}
