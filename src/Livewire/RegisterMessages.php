<?php

namespace RalphJSmit\Helpers\Livewire;

trait RegisterMessages
{
    protected function registerMessages(array $messages): void
    {
        $this->messages = array_merge($this->messages, $messages);
    }
}
