<?php

use RalphJSmit\Helpers\Laravel\Pipe\Pipe;

it('can pipe thingies through a pipe', function () {
    $thing = 'a';

    $result = pipe()
        ->send($thing)
        ->through([
            new class
            {
                public function execute($input) { return $input . 'b'; }
            },
            new class
            {
                public function execute($input) { return $input . 'c'; }
            },
        ])
        ->via('execute')
        ->then(function ($thing) {
            return $thing . 'z';
        });

    expect($result)
        ->toBe('abcz');
});

it('can pipe invokeable classes through a pipe and keep the original', function () {
    $thing = new class
    {
        public array $inputs = [];
    };

    $result = pipe($thing)
        ->through([
            new class
            {
                public function __invoke($input)
                {
                    $input->inputs[] = 'a';
                }
            },
            function ($input) {
                $input->inputs[] = 'b';
            },
        ])
        ->preserveOriginal()
        ->thenReturn();

    expect($result)
        ->toBe($thing)
        ->inputs->toBe(['a', 'b']);
});

it('can pipe invokeable classes through a pipe with the container and keep the original', function () {
    $thing = new class
    {
        public array $inputs = [];
    };

    $result = pipe($thing)
        ->when(false, function (Pipe $pipe) {
            return $pipe->send("SHOULD_NOT_HAPPEN");
        })
        ->through([
            TestClassPipeTest::class,
            TestClassPipeTest::class,
        ])
        ->preserveOriginal()
        ->thenReturn();

    expect($result)
        ->toBe($thing)
        ->inputs->toBe(['a', 'a']);
});

class TestClassPipeTest
{
    public function __invoke($input)
    {
        $input->inputs[] = 'a';
    }
}