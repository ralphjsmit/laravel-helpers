<?php

namespace RalphJSmit\Helpers\Laravel\Factories;

use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Factory extends \Illuminate\Database\Eloquent\Factories\Factory
{
    /**
     * @param class-string<HasFactory> $relationshipModel
     */
    protected function resolveRelationship(string $relationshipModel, Model|self|Closure|int|null $relationship): self|Model|int
    {
        if ( is_int($relationship) ) {
            return $relationship;
        }

        if ( $relationship instanceof self ) {
            return $relationship;
        }

        if ( $relationship instanceof Model ) {
            return $relationship;
        }

        $factory = $relationshipModel::factory();

        if ( $relationship instanceof Closure ) {
            $factory = $relationship($factory);
        }

        return $factory;
    }
}