<?php

namespace RalphJSmit\Helpers\Livewire;

use Livewire\Attributes\On;

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
    #[On('$refresh')]
    public function refreshInternal(): void
    {
        //
    }
}
