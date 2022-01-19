<?php

namespace RalphJSmit\Helpers\Livewire;

trait CanBeRefreshed
{
    protected function initializeCanBeRefreshed(): void
    {
        $this->listeners = array_merge($this->listeners, [
            '$refresh' => '$refresh',
        ]);
    }
}
