<?php

use Illuminate\Testing\Assert;
use Livewire\Component;
use Livewire\Livewire;
use RalphJSmit\Helpers\Livewire\RegisterMessages;

it('can register messages in a Livewire component', function () {
    $component = Livewire::test(RegisterMessagesTestComponent::class);

    $component
        ->call('assert');
});

trait MyCustomRegisterMessagesTestTrait
{
    use RegisterMessages;

    public function initializeMyCustomRegisterMessagesTestTrait()
    {
        $this->registerMessages([
            'email.required' => 'Custom message II',
            'email.emaim' => 'Custom message III',
        ]);
    }
}

class RegisterMessagesTestComponent extends Component
{
    use MyCustomRegisterMessagesTestTrait;

    protected $messages = [
        'age.numeric' => 'Custom message I',
    ];

    public function render()
    {
        return '<div></div>';
    }

    public function assert()
    {
        Assert::assertEquals([
            'age.numeric' => 'Custom message I',
            'email.required' => 'Custom message II',
            'email.emaim' => 'Custom message III',
        ], $this->messages);
    }
}
