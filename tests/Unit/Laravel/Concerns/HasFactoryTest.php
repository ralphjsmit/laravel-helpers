<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Helpers\Laravel\Actions\GuessFactoryAction;
use RalphJSmit\Helpers\Laravel\Concerns\HasFactory;

it('can return the correct factory for a model', function () {
    $spy = $this->spy(GuessFactoryAction::class);

    $factory = FactoryModel::factory();

    expect($factory)
        ->toBeInstanceOf(FactoryModelFactory::class);

    $spy
        ->shouldHaveReceived('execute')
        ->with(FactoryModel::class);
});

class FactoryModel extends Model
{
    use HasFactory;

    protected $factory = FactoryModelFactory::class;
    protected $guarded = [];
}

class FactoryModelFactory extends Factory
{
    public function definition(): array
    {
        return [];
    }
}
