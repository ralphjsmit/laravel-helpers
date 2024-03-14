<?php

use RalphJSmit\Helpers\Laravel\Actions\GuessFactoryAction;
use RalphJSmit\Helpers\Laravel\Support\NamespaceManager;

it('can guess the name of a factory', function (
    string $input,
    string $expectedGuess,
    ?bool $guessFactoryNamesWithDomainNamespace = null,
    ?bool $guessFactoryNamesWithSupportNamespace = null
): void {
    if (is_bool($guessFactoryNamesWithDomainNamespace)) {
        config()->set('helpers.laravel.guess_factory_names_with_domain_namespace', $guessFactoryNamesWithDomainNamespace);
    }
    if (is_bool($guessFactoryNamesWithSupportNamespace)) {
        config()->set('helpers.laravel.guess_factory_names_with_support_namespace', $guessFactoryNamesWithSupportNamespace);
    }

    $guess = app(GuessFactoryAction::class)->execute($input);

    expect($guess)
        ->toBe($expectedGuess);
}
)->with([
    [FactoryModel::class, ''],
    ['App\\Models\\User', 'Database\\Factories\\UserFactory'],
    ['App\\Models\\X\\User', 'Database\\Factories\\X\\UserFactory'],
    ['Domain\\Blog\\Models\\User', 'Database\\Factories\\Domain\\Blog\\UserFactory'], // Config 'guess_factory_names_with_domain_namespace' default is true
    ['Domain\\Blog\\Models\\User', 'Database\\Factories\\Blog\\UserFactory', false],
    ['Support\\Models\\User', 'Database\\Factories\\Support\\UserFactory', false],  // Config 'guess_factory_names_with_support_namespace' default is true
    ['Support\\Blog\\Models\\User', 'Database\\Factories\\Blog\\UserFactory', false, false],
    ['Models\\X\\User', 'Database\\Factories\\X\\UserFactory'],
    ['App\\X\\X\\User', ''],
    ['User', ''],
]);

it('can guess the name of a factory for a package', function (
    string $input,
    string $expectedGuess,
    ?bool $guessFactoryNamesWithDomainNamespace,
    ?bool $guessFactoryNamesWithSupportNamespace,
    string $pathToModel,
    array $packageNamespaces = [],
): void {
    if (is_bool($guessFactoryNamesWithDomainNamespace)) {
        config()->set('helpers.laravel.guess_factory_names_with_domain_namespace', $guessFactoryNamesWithDomainNamespace);
    }
    if (is_bool($guessFactoryNamesWithSupportNamespace)) {
        config()->set('helpers.laravel.guess_factory_names_with_support_namespace', $guessFactoryNamesWithSupportNamespace);
    }

    foreach ($packageNamespaces as $packageNamespacePath => $packageNamespace) {
        NamespaceManager::registerNamespace($packageNamespace, $packageNamespacePath);
    }

    $guess = app(GuessFactoryAction::class)->execute($input, $pathToModel);

    expect($guess)
        ->toBe($expectedGuess);
}
)->with([
    [
        'RalphJSmit\\Filament\\CMS\\Blog\\Models\\Page',
        'RalphJSmit\\Filament\\CMS\\Database\\Factories\\Blog\\PageFactory',
        false,
        true,
        '/users/packages/my-package/src',
        ['/users/packages/my-package/src' => 'RalphJSmit\\Filament\\CMS\\'],
    ],
    [
        'RalphJSmit\\Filament\\CMS\\Blog\\Models\\Page',
        'Database\\Factories\\RalphJSmit\\Filament\\CMS\\Blog\\PageFactory',
        false,
        true,
        '/users/packages/my-other-package/src',
        ['/users/packages/my-package/src' => 'RalphJSmit\\Filament\\CMS\\'],
    ],
]);

expect('it can guess the name of a factory in regular Laravel model structure', function () {
});
