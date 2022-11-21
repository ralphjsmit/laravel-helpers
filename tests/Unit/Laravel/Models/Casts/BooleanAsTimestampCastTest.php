<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use RalphJSmit\Helpers\Laravel\Models\Casts\BooleanAsTimestampCast;

it('can use a timestamp as a boolean', function () {
    $model = new class extends Model
    {
        protected $casts = [
            'boolean' => BooleanAsTimestampCast::class,
        ];
    };

    $model->boolean = true;

    expect($model->boolean)
        ->toBeTrue()
        ->and($model->getAttributes()['boolean'])->toBeInstanceOf(Carbon::class);

    $model->boolean = false;

    expect($model->boolean)
        ->toBeFalse()
        ->and($model->getAttributes()['boolean'])->toBeNull();
});
