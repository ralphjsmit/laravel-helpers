<?php

// This file contains some miscellaneous helpers for Laravel,
// that should be available everywhere.

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

if ( ! function_exists('carbon') ) {
    function carbon(mixed $input = null, string $timezone = null): Carbon
    {
        return Carbon::parse($input, $timezone);
    }
}

if ( ! function_exists('carbonDate') ) {
    // This function returns a Carbon instance and floors the date, so
    // that the time is always at midnight.
    function carbonDate(mixed $input = null, string $timezone = null): Carbon
    {
        return Carbon::parse($input, $timezone)->floorDay();
    }
}

if ( ! function_exists('tomorrow') ) {
    function tomorrow(string $timezone = null): Carbon
    {
        return now($timezone)->addDay();
    }
}

if ( ! function_exists('yesterday') ) {
    function yesterday(string $timezone = null): Carbon
    {
        return now($timezone)->subDay();
    }
}

if ( ! function_exists('daysOfMonth') ) {
    function daysOfMonth(Carbon|string $month): Collection
    {
        $month = is_string($month) ? carbon($month) : $month;

        $daysInMonth = $month->daysInMonth;

        $daysOfMonth = collect();

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $daysOfMonth->put($i, 0);
        }

        return $daysOfMonth;
    }
}

if ( ! function_exists('pipeline') ) {
    function pipeline(mixed $passable = null): Pipeline
    {
        return $passable ? app(Pipeline::class)->send($passable) : app(Pipeline::class);
    }
}
