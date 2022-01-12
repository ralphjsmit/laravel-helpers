<?php

use RalphJSmit\Helpers\Laravel\Actions\GuessFactoryAction;

it(
    'can guess the name of a factory',
    function (string $input, string $expectedGuess, bool $guessFactoryNamesWithDomainNamespace = null, bool $guessFactoryNamesWithSupportNamespace = null, bool $asPackage = false) {
        if ( is_bool($guessFactoryNamesWithDomainNamespace) ) {
            config()->set('helpers.laravel.guess_factory_names_with_domain_namespace', $guessFactoryNamesWithDomainNamespace);
        }
        if ( is_bool($guessFactoryNamesWithSupportNamespace) ) {
            config()->set('helpers.laravel.guess_factory_names_with_support_namespace', $guessFactoryNamesWithSupportNamespace);
        }

        $guess = app(GuessFactoryAction::class)->execute($input, $asPackage);

        expect($guess)
            ->toBe($expectedGuess);
    }
)->with([
    [FactoryModel::class, ''],
    ['App\\Models\\User', 'Database\\Factories\\UserFactory'],
    ['App\\Models\\X\\User', 'Database\\Factories\\X\\UserFactory'],
    ['Domain\\Blog\\Models\\User', 'Database\\Factories\\Blog\\UserFactory', false],
    ['Domain\\Blog\\Models\\User', 'Database\\Factories\\Domain\\Blog\\UserFactory', true],
    ['Support\\Models\\User', 'Database\\Factories\\Support\\UserFactory', false, true],
    ['Support\\Blog\\Models\\User', 'Database\\Factories\\Blog\\UserFactory', false, false],
    ['Models\\X\\User', 'Database\\Factories\\X\\UserFactory'],
    ['App\\X\\X\\User', ''],
    ['User', ''],
    ['RalphJSmit\\Filament\\CMS\\Blog\\Models\\Page', 'Database\\Factories\\RalphJSmit\\Filament\\CMS\\Blog\\PageFactory', false, true, false],
    ['RalphJSmit\\Filament\\CMS\\Blog\\Models\\Page', 'RalphJSmit\\Filament\\CMS\\Database\\Factories\\Blog\\Models\\Page', false, true, true],
]);

expect('it can guess the name of a factory in regular Laravel model structure', function () {});
