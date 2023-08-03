<?php

namespace RalphJSmit\Helpers\Livewire;

trait CanBeRefreshed
{
    /**
     * Livewire V2.
     */
    public function initializeCanBeRefreshed(): void
    {
        $this->listeners = array_merge($this->listeners, [
            '$refresh' => '$refresh',
        ]);
    }

    /**
     * Livewire V3.
     */
    public function CanBeRefreshedInitialize(): void
    {
        $this->listeners = array_merge($this->listeners, [
            '$refresh' => '$refresh',
        ]);
    }
}
