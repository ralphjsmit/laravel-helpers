<?php

use RalphJSmit\Helpers\Laravel\Actions\GuessFactoryAction;

it('can guess the name of a factory', function (string $input, string $expectedGuess, bool $guessFactoryNamesWithDomain = false) {
    config()->set('helpers.laravel.guess_factory_names_with_domain', $guessFactoryNamesWithDomain);

    $guess = app(GuessFactoryAction::class)->execute($input);

    expect($guess)
        ->toBe($expectedGuess);
})->with([
    [FactoryModel::class, ''],
    ['App\\Models\\User', 'Database\\Factories\\UserFactory'],
    ['App\\Models\\X\\User', 'Database\\Factories\\X\\UserFactory'],
    ['Domain\\Blog\\Models\\User', 'Database\\Factories\\Blog\\UserFactory', false],
    ['Domain\\Blog\\Models\\User', 'Database\\Factories\\Domain\\Blog\\UserFactory', true],
    ['Models\\X\\User', 'Database\\Factories\\X\\UserFactory'],
    ['App\\X\\X\\User', ''],
    ['User', ''],
]);

expect('it can guess the name of a factory in regular Laravel model structure', function () {});
