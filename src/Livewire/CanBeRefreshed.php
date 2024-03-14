<?php

namespace RalphJSmit\Helpers\Livewire;

use Livewire\Attributes\On;

trait CanBeRefreshed
{
    #[On('$refresh')]
    public function refreshInternal(): void
    {
        //
    }
}
