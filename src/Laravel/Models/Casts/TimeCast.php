<?php

namespace RalphJSmit\Helpers\Laravel\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Carbon;

class TimeCast implements CastsAttributes
{
    /** This method is used to convert a raw value from the database into a Carbon instance. */
    public function get($model, string $key, $value, array $attributes): ?Carbon
    {
        if ( $value === null ) {
            return null;
        }

        return carbon($value);
    }

    /** Convert an input like a Carbon instance or a string or null to a raw value for the database. */
    public function set($model, string $key, $value, array $attributes): ?string
    {
        return $value instanceof Carbon
            ? $value->format('H:i:s')
            : $value;
    }
}