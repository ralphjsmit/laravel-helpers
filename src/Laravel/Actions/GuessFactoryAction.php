<?php

namespace RalphJSmit\Helpers\Laravel\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class GuessFactoryAction
{
    public function execute(string $input): string
    {
        if ( Str::startsWith($input, 'App\\Models\\') ) {
            $modelName = Str::after($input, 'App\\Models\\');
            $namespace = '';

            return "Database\\Factories\\{$namespace}{$modelName}Factory";
        }

        if ( Str::contains($input, 'Models\\') ) {
            $modelName = Str::after($input, 'Models\\');
            $namespace = Str::of($input)
                ->before('Models\\')
                ->when(
                    Str::startsWith($input, 'Domain') && ! config('helpers.laravel.guess_factory_names_with_domain_namespace'),
                    fn (Stringable $str) => $str->after('Domain\\')
                )
                ->when(
                    Str::startsWith($input, 'Support') && ! config('helpers.laravel.guess_factory_names_with_support_namespace'),
                    fn (Stringable $str) => $str->after('Support\\')
                );

            return "Database\\Factories\\{$namespace}{$modelName}Factory";
        }

        return '';
    }
}
