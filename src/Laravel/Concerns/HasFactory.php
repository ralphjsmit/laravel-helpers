<?php

namespace RalphJSmit\Helpers\Laravel\Concerns;

use Illuminate\Database\Eloquent\Factories\Factory;
use RalphJSmit\Helpers\Laravel\Actions\GuessFactoryAction;

trait HasFactory
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    public static function newFactory(): Factory
    {
        $guess = app(GuessFactoryAction::class)->execute(static::class);

        if ( $guess ) {
            return $guess::new();
        }

        return ( new static )->factory::new();
    }
}
