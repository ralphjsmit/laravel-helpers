<?php

use Illuminate\Testing\Assert;
use Livewire\Component;
use Livewire\Livewire;
use RalphJSmit\Helpers\Livewire\RegisterListeners;

it('can register events in a Livewire component', function () {
    $component = Livewire::test(RegisterListenersTestComponent::class);

    $component
        ->call('assert');
});

trait MyCustomRegisterListenersTestTrait
{
    use RegisterListeners;

    public function initializeMyCustomRegisterListenersTestTrait()
    {
        $this->registerListeners([
            'eventA' => 'methodA',
            'eventB' => 'methodB',
        ]);
    }
}

class RegisterListenersTestComponent extends Component
{
    use MyCustomRegisterListenersTestTrait;

    protected $listeners = [
        'initialEvent' => 'methodForInitialEvent',
    ];

    public function render()
    {
        return '<div></div>';
    }

    public function assert()
    {
        Assert::assertEquals([
            'initialEvent' => 'methodForInitialEvent',
            'eventA' => 'methodA',
            'eventB' => 'methodB',
        ], $this->listeners);
    }
}
