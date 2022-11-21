<?php

namespace RalphJSmit\Helpers\Laravel\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Carbon;

class TimeCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?Carbon
    {
        if ( $value === null ) {
            return null;
        }

        return carbon($value);
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        return $value instanceof Carbon
            ? $value->format('H:i:s')
            : $value;
    }
}