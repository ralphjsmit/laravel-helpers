<?php

namespace RalphJSmit\Helpers\Laravel\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use RalphJSmit\Helpers\Laravel\Support\NamespaceManager;

class GuessFactoryAction
{
    public function execute(string $input, string $dir = null): string
    {
        $packageNamespace = $dir ? app(NamespaceManager::class)->findNamespace($dir) : '';

        if ( Str::startsWith($input, 'App\\Models\\') ) {
            $modelName = Str::after($input, 'App\\Models\\');
            $namespace = '';

            return "Database\\Factories\\{$namespace}{$modelName}Factory";
        }

        if ( Str::contains($input, 'Models\\') ) {
            $modelName = Str::after($input, 'Models\\');
            $namespace = Str::of($input)
                ->before('Models\\')
                ->when($this->shouldGuessWithDomainNamespace($input), fn (Stringable $str) => $str->after('Domain\\'))
                ->when($this->shouldGuessWithSupportNamespace($input), fn (Stringable $str) => $str->after('Support\\'))
                ->when($packageNamespace, fn (Stringable $str) => $str->remove($packageNamespace));

            return "{$packageNamespace}Database\\Factories\\{$namespace}{$modelName}Factory";
        }

        return '';
    }

    protected function shouldGuessWithDomainNamespace(string $input): bool
    {
        return Str::startsWith($input, 'Domain') && ! config('helpers.laravel.guess_factory_names_with_domain_namespace');
    }

    protected function shouldGuessWithSupportNamespace(string $input): bool
    {
        return Str::startsWith($input, 'Support') && ! config('helpers.laravel.guess_factory_names_with_support_namespace');
    }
}
