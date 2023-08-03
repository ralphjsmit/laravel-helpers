<?php

namespace RalphJSmit\Helpers\Livewire;

trait CanBeRefreshed
{
    public function initializeCanBeRefreshed(): void
    {
        $this->listeners = array_merge($this->listeners, [
            '$refresh' => '$refresh',
        ]);
    }

    public function CanBeRefreshedInitialize(): void
    {
        $this->listeners = array_merge($this->listeners, [
            '$refresh' => '$refresh',
        ]);
    }
}
