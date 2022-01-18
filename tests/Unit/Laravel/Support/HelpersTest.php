<?php

use Illuminate\Support\Carbon;

it('can return a carbon::parse instance from carbon()', function () {
    $carbon = carbon();
    expect($carbon)->toBeInstanceOf(Carbon::class);

    $carbon = carbon('2022-01-01 00:00:00');
    expect($carbon)
        ->toDateTimeString()
        ->toBe('2022-01-01 00:00:00');
});
