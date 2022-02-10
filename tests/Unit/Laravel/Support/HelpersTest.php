<?php

use Illuminate\Support\Carbon;

it('can return a carbon::parse instance from carbon()', function () {
    $carbon = carbon();
    expect($carbon)->toBeInstanceOf(Carbon::class);

    $carbon = carbon('2022-01-31 10:08:00');
    expect($carbon)
        ->toDateTimeString()
        ->toBe('2022-01-31 10:08:00');
});

it('can return a carbon instance for a date', function () {
    $date = carbonDate();
    expect($date)->toBeInstanceOf(Carbon::class);

    $date = carbonDate('2022-01-31');
    expect($date)
        ->toDateTimeString()
        ->toBe('2022-01-31 00:00:00');
});

it('can return a carbon instance for tomorrow', function () {
    $tomorrow = tomorrow();

    expect($tomorrow->toDateString())
        ->toBe(now()->addDay()->toDateString());
});

it('can return a carbon instance for yesterday', function () {
    $yesterday = yesterday();

    expect($yesterday->toDateString())
        ->toBe(now()->subDay()->toDateString());
});
