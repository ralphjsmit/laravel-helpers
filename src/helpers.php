<?php

use RalphJSmit\Helpers\Laravel\Pipe\Pipe;

if ( ! function_exists('is_enum') ) {
    function is_enum(object $potentialEnum): bool
    {
        return $potentialEnum instanceof StringBackedEnum || $potentialEnum instanceof BackedEnum || $potentialEnum instanceof IntBackedEnum;
    }
}

if ( ! function_exists('pipe') ) {
    function pipe(mixed $passable = null): Pipe
    {
        return $passable ? app(Pipe::class)->send($passable) : app(Pipe::class);
    }
}
