<?php

// This file contains some miscellaneous helpers for Laravel,
// that should be available everywhere.

use Illuminate\Support\Carbon;

if ( ! function_exists('carbon') ) {
    function carbon(mixed $input = null)
    {
        return Carbon::parse($input);
    }
}
