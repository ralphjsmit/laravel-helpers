<?php

namespace RalphJSmit\Helpers\Laravel\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Carbon;

class BooleanAsTimestampCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): bool
    {
        return $value !== null;
    }

    public function set($model, string $key, $value, array $attributes): null|Carbon
    {
        if ( ! $value ) {
            return null;
        }

        return Carbon::now();
    }
}