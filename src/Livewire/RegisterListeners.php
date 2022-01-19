<?php

namespace RalphJSmit\Helpers\Livewire;

trait RegisterListeners
{
    protected function registerListeners(array $listeners): void
    {
        $this->listeners = array_merge($this->listeners, $listeners);
    }
}
