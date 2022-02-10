<?php

// This file contains some miscellaneous helpers for Laravel,
// that should be available everywhere.

use Illuminate\Support\Carbon;

if ( ! function_exists('carbon') ) {
    function carbon(mixed $input = null): Carbon
    {
        return Carbon::parse($input);
    }
}

if ( ! function_exists('carbonDate') ) {
    // This function returns a Carbon instance and floors the date, so
    // that the time is always at midnight.
    function carbonDate(mixed $input = null): Carbon
    {
        return Carbon::parse($input)->floorDay();
    }
}

if ( ! function_exists('tomorrow') ) {
    function tomorrow(): Carbon
    {
        return now()->addDay();
    }
}

if ( ! function_exists('yesterday') ) {
    function yesterday(): Carbon
    {
        return now()->subDay();
    }
}
