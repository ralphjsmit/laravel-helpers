<?php

use RalphJSmit\Helpers\Laravel\Pipe\Pipeable;

it('can pipe thingies through a pipe', function () {
    $thing = new class
    {
        use Pipeable;

        public string $input = 'a';
    };

    $result = $thing
        ->pipeThrough([
            new class
            {
                public function __invoke($input)
                {
                    return $input->input.'b';
                }
            },
            new class
            {
                public function __invoke($input)
                {
                    return $input.'c';
                }
            },
        ]);

    expect($result)
        ->toBe('abc');
});

it('can pipe invokeable classes through a pipe and keep the original', function () {
    $thing = new class
    {
        use Pipeable;

        public array $inputs = [];
    };

    $result = $thing
        ->pipe(
            new class
            {
                public function __invoke($input)
                {
                    $input->inputs[] = 'a';

                    return $input;
                }
            }
        )
        ->pipe(function ($input) {
            $input->inputs[] = 'b';

            return $input;
        });

    expect($result)
        ->toBe($thing)
        ->inputs->toBe(['a', 'b']);
});

it('can pipe a thing into another thing', function () {
    $thing = new class
    {
        use Pipeable;
    };

    $result = $thing
        ->pipeInto(TestClassPipeableTest::class);

    expect($result->thing)
        ->toBe($thing);
});

class TestClassPipeableTest
{
    public function __construct(
        public mixed $thing
    ) {
    }
}
