<?php

use Livewire\Component;
use Livewire\Livewire;
use RalphJSmit\Helpers\Livewire\CanBeRefreshed;

it('can refresh the component', function () {
    $component = Livewire::test(CanBeRefreshedTestComponent::class);

    $component
        ->emit('$refresh')
        ->emit('$refresh')
        ->assertSet('renderedTimes', 3);
});

class CanBeRefreshedTestComponent extends Component
{
    use CanBeRefreshed;

    public int $renderedTimes = 0;

    public function render()
    {
        $this->renderedTimes++;

        return '<div></div>';
    }
}
