<?php

use RalphJSmit\Helpers\Laravel\Support\NamespaceManager;

it('can collect namespaces', function () {
    $managerA = app(NamespaceManager::class);
    $managerB = app(NamespaceManager::class);

    expect($managerA)->toBe($managerB);
});

it('can add namespaces to the manager', function () {
    $managerA = app(NamespaceManager::class);
    $managerB = app(NamespaceManager::class);

    $managerA->addNamespace('RalphJSmit\\Helpers', '/path/to/helpers');

    expect($managerA)
        ->getNamespaces()->toBe(['/path/to/helpers' => 'RalphJSmit\\Helpers']);

    expect($managerB)
        ->getNamespaces()->toBe(['/path/to/helpers' => 'RalphJSmit\\Helpers']);
});

it('can add namespaces to the manager via the static method', function () {
    $managerA = app(NamespaceManager::class);
    $managerB = app(NamespaceManager::class);

    NamespaceManager::registerNamespace('RalphJSmit\\Helpers', '/path/to/helpers');

    expect($managerA)
        ->getNamespaces()->toBe(['/path/to/helpers' => 'RalphJSmit\\Helpers']);

    expect($managerB)
        ->getNamespaces()->toBe(['/path/to/helpers' => 'RalphJSmit\\Helpers']);
});

it('can check whether a directory belongs to a namespace', function (string $input, string $inputPath, string $findFromPath, string $expected) {
    $manager = app(NamespaceManager::class);

    $manager->addNamespace($input, $inputPath);

    $associatedNamespace = $manager->findNamespace($findFromPath);

    expect($associatedNamespace)->toBe($expected);
})->with([
    ['RalphJSmit\\Helpers\\', '/path/to/helpers', '/path/to/helpers/Support', 'RalphJSmit\\Helpers\\'],
    ['RalphJSmit\\Helpers\\', '/path/to/helpers', '/path/to/another/helper/Support', ''],
    ['RalphJSmit\\Filament\\CMS\\', '/path/to/filament', '/path/to/filament/src/Blog/Models/', 'RalphJSmit\\Filament\\CMS\\'],
]);
