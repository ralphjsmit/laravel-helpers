<?php

namespace RalphJSmit\Helpers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RalphJSmit\Helpers\Commands\HelpersCommand;

class HelpersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-helpers')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-helpers_table')
            ->hasCommand(HelpersCommand::class);
    }
}
