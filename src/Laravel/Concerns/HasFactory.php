<?php

namespace RalphJSmit\Helpers\Laravel\Concerns;

use Illuminate\Database\Eloquent\Factories\Factory;
use RalphJSmit\Helpers\Laravel\Actions\GuessFactoryAction;
use ReflectionClass;

trait HasFactory
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    public static function newFactory(): Factory
    {
        $pathToCurrentModel = dirname(( new ReflectionClass(self::class) )->getFileName());

        $guess = app(GuessFactoryAction::class)->execute(self::class, $pathToCurrentModel);

        if ( $guess ) {
            return $guess::new();
        }

        return ( new static )->factory::new();
    }
}
