<?php

namespace RalphJSmit\Helpers;

use RalphJSmit\Helpers\Laravel\Macros\RequestMacros;
use RalphJSmit\Helpers\Laravel\Support\NamespaceManager;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HelpersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-helpers')
            ->hasConfigFile();

        $this->registerMacros();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(NamespaceManager::class, fn () => new NamespaceManager());
    }

    protected function registerMacros()
    {
        RequestMacros::register();
    }
}
