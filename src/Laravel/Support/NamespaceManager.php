<?php

namespace RalphJSmit\Helpers\Laravel\Support;

use Illuminate\Support\Str;

class NamespaceManager
{
    protected array $namespaces = [];

    public function addNamespace(string $namespace, string $path): static
    {
        $this->namespaces[$path] = $namespace;

        return $this;
    }

    public function findNamespace(string $path): string
    {
        foreach ($this->getNamespaces() as $namespacePath => $namespace) {
            if ( Str::contains($path, $namespacePath) ) {
                return $namespace;
            }
        }

        return "";
    }

    public function getNamespaces(): array
    {
        return $this->namespaces;
    }

    public static function registerNamespace(string $namespace, string $path): static
    {
        $manager = app(static::class)->addNamespace($namespace, $path);

        //        dump($manager);

        return $manager;
    }
}
