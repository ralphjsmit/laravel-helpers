<?php

use Livewire\Component;
use Livewire\Livewire;
use RalphJSmit\Helpers\Livewire\CanBeRefreshed;

it('can refresh the component on Livewire V2', function () {
    $component = Livewire::test(CanBeRefreshedTestComponent::class);

    $method = match (true) {
        method_exists($component, 'emit') => 'emit',
        method_exists($component, 'dispatch') => 'dispatch',
    };

    $component
        ->{$method}(
            '$refresh'
        )
        ->{$method}(
            '$refresh'
        )
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
