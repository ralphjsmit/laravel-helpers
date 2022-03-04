<?php

use Illuminate\Support\Carbon;

it('can return a carbon::parse instance from carbon()', function () {
    $carbon = carbon();
    expect($carbon)->toBeInstanceOf(Carbon::class);

    $carbon = carbon('2022-01-31 10:08:00', 'Europe/Amsterdam');
    expect($carbon)
        ->toDateTimeString()
        ->toBe('2022-01-31 10:08:00');

    expect($carbon)
        ->timezone
        ->getName()
        ->toBe('Europe/Amsterdam');
});

it('can return a carbon instance for a date', function () {
    $date = carbonDate();
    expect($date)->toBeInstanceOf(Carbon::class);

    $date = carbonDate('2022-01-31', 'Europe/Amsterdam');

    expect($date)
        ->toDateTimeString()
        ->toBe('2022-01-31 00:00:00');

    expect($date)
        ->timezone
        ->getName()
        ->toBe('Europe/Amsterdam');
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

it('can return a collection with the days of a month as the keys', function (string $month, array $expected) {
    $month = carbon($month);

    $days = daysOfMonth($month);

    expect($days->all())->toBe($expected);
})->with([
    ['february 2021', [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0, 13 => 0, 14 => 0, 15 => 0, 16 => 0, 17 => 0, 18 => 0, 19 => 0, 20 => 0, 21 => 0, 22 => 0, 23 => 0, 24 => 0, 25 => 0, 26 => 0, 27 => 0, 28 => 0]],
    [
        'march 2021',
        [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
            13 => 0,
            14 => 0,
            15 => 0,
            16 => 0,
            17 => 0,
            18 => 0,
            19 => 0,
            20 => 0,
            21 => 0,
            22 => 0,
            23 => 0,
            24 => 0,
            25 => 0,
            26 => 0,
            27 => 0,
            28 => 0,
            29 => 0,
            30 => 0,
            31 => 0,
        ],
    ],
]);
