<?php

namespace RalphJSmit\Helpers\Laravel\Macros;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Collection;

class RequestMacros
{
    public static function register(): void
    {
        Request::macro('collect', function (): Collection {
            return collect(
                json_decode(
                    json: $this->body(),
                    flags: JSON_OBJECT_AS_ARRAY
                )
            );
        });
    }

}
