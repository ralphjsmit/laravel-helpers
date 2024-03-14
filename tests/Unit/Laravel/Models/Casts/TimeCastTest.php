<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use RalphJSmit\Helpers\Laravel\Models\Casts\TimeCast;

it('can cast a time attribute to a carbon instance and back to a time attribute', function () {
    $model = new class extends Model
    {
        protected $casts = [
            'time' => TimeCast::class,
        ];
    };

    $model->time = '12:00:00';
    expect($model->time)->toBeInstanceOf(Carbon::class);

    $model->time = null;
    expect($model->time)->toBeNull();
});
