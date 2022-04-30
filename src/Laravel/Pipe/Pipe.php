<?php

namespace RalphJSmit\Helpers\Laravel\Pipe;

use Closure;
use Illuminate\Contracts\Pipeline\Pipeline;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;

class Pipe implements Pipeline
{
    use Conditionable;

    protected string $method = 'handle';

    protected mixed $passable;

    protected array $pipes = [];

    protected bool $preservePassable = false;

    public function send(mixed $traveler): static
    {
        $this->passable = $traveler;

        return $this;
    }

    public function through(mixed $stops)
    {
        $this->pipes = $stops;

        return $this;
    }

    public function via(mixed $method)
    {
        $this->method = $method;

        return $this;
    }

    public function preserveOriginal(): static
    {
        $this->preservePassable = true;

        return $this;
    }

    public function then(Closure $destination): mixed
    {
        $passable = $this->executePipe();

        return $destination($passable);
    }

    public function thenReturn(): mixed
    {
        $passable = $this->executePipe();

        return $this->preservePassable ? $this->passable : $passable;
    }

    protected function executePipe(): mixed
    {
        return Collection::make($this->pipes)
            ->reduce(function (mixed $carry, mixed $item) {
                $carry = $this->preservePassable ? $this->passable : $carry;

                $item = $this->parsePipe($item);

                if ( is_callable($item) ) {
                    return $item($carry);
                }

                return $item->{$this->method}($carry);
            }, $this->passable);
    }

    protected function parsePipe(mixed $item): mixed
    {
        return is_object($item) || is_callable($item)
            ? $item
            : app($item);
    }
}