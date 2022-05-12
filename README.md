# A package containing handy helpers for your Laravel-application.

This package contains a set of handy helpers for your Laravel-application.

## Installation

You can install the package via composer:

```bash
composer require ralphjsmit/laravel-helpers
```

## Laravel

### Pipes, pipelines & pipeable

#### Pipes v. pipelines

Laravel has an undocumented feature called Pipelines. Pipelines are handy for sending data through a series of functions/classes.

The pipelines in Laravel, however, have one big downside: inside every function or class, you need to call a closure to move to the next pipe in the pipeline. If you don't call that closure, the pipeline stops. Laravel Middleware is a great example of this.

However, sometimes you don't want that closure and just pass the result of the first pipe into the second pipe, meaning that the full pipeline always gets executed. This package offers a custom implementation for that, called a "pipe". You don't have a way to stop execution (use a regular pipeline instead), but you don't have to call the closure inside each pipe either.

From now on, I'll call the custom implementation of this package a "pipe" and the more advanced, regular Laravel-implementation a "pipeline".

#### Pipeline

You can use the `pipeline()` function to create a new pipeline:

```php
$result = pipeline()
  ->send($class)
  ->through($pipes)
  ->thenReturn();
```

To learn more about pipelines, [check out this article](https://jeffochoa.me/understanding-laravel-pipelines).

#### Pipe

You can create a new pipe with the `pipe()` function:

```php
$result = pipe($thing)
  ->through([
    PerformAction::class,
    PerformAnotherAction::class,
  ])
  ->then(function($result) {
    // Do something with $result and return it.
    return $result;
  });
```

Each of the items in the `->through()` array can be one of the following:

1. A closure or callable
2. An invokable class (which is a callable as well)
3. A class instance
4. A class string

By default, the pipe will try to execute each item with via a method 'handle'. You can change that method by using the `->via()` method.

At the end of each pipe, you can pass a closure to the `->then()` method to do something with the result. To immedialtely return the result, you can also use the `->thenReturn()` method.

```php
$result = pipe($thing)
  ->through(/** */)
  ->via('execute')
  ->thenReturn();
````

#### Pipeable

This package also offers a handy trait that you can use to make your classes pipeable. If you include this trait, your classes will have the following new methods:

1. `->pipe($callback)`. This method passes the object to the given closure or callable and returns the result of the executed callable.
2. `->pipeInto($class)`. The `pipeInto()` method creates a new instance of the given class and passes the object into the constructor.
3. `->pipeThrough($callbacks)`. The `pipeThrough()` method passes the object to the given array of closures/callables and returns the result of the executed callbacks.

All three methods are the same as the three identically named methods in the `\Illuminate\Support\Collection` class. For examples, see the docs for [`pipe()`](https://laravel.com/docs/9.x/collections#method-pipe), [`pipeInto()`](https://laravel.com/docs/9.x/collections#method-pipeinto) and [`pipeThrough()`](https://laravel.com/docs/9.x/collections#method-pipethrough)` on the Laravel site.

### Carbon

The package offers several handy helpers to make working with Carbon-objects more pleasant.

### `carbon($input = null, $timezone = null)`

You can use the `carbon($input, $timezone)` helper to create a Carbon-object. Under the hood, this uses `Carbon::parse()`. Both parameters are optional.

```php
$firstDayOfNextMonth = carbon('first day of next month', 'Europe/Amsterdam');
```

#### `carbonDate($input = null, $timezone = null)`

You can use the `carbonDate($input, $timezone)` helper to create a Carbon-object and floor the day to 00:00:00. Under the hood, this uses `Carbon::parse()->floorDay()`. Both parameters are optional.

```php
$firstDayOfNextMonth = carbonDate('first day of next month', 'Europe/Amsterdam');

$firstDayOfNextMonth->toTimeString();
// '00:00:00'
```

#### `yesterday()` and `tomorrow()`

You can use the `tomorrow()` function to create a Carbon-instance for tomorrow. Under the hood this uses `now()->addDay()`.

You can use the `yesterday()` function to create a Carbon-instance for yesterday. Under the hood this uses `now()->subDay()`.

```php
$tomorrow = tomorrow();
$yesterday = yesterday();
```

#### `daysOfMonth(Carbon|string $month)`

You can use the `daysOfMonth()` function to create a `Collection` instance with the days of the month as numeric keys and a value of `0`. Useful for creating things like graphs and the like.

```php
$days = daysOfMonth(carbon('march 2021'));

$days->all();
//          [
//            1 => 0,
//            2 => 0,
//            3 => 0,
//            4 => 0,
//            5 => 0,
//            ...
//            30 => 0,
//            31 => 0,
//         ]
```

### Eloquent

#### TimeCast

Eloquent provides many nice casts, like `array`, `date` and `datetime`. However, Laravel doesn't provide with a `time` cast, for storing and casting timestamps like "08:30:00" to a Carbon instance.

The reason is probably that passing only a timestamp like "08:30:00" to Carbon assumes a Carbon instance with the current date. This might or might not be a problem for you.

In order to cast a timestring to a Carbon instance, you can set the `TimeCast` class as a cast. However, please be aware that this will create a carbon instance that assumes the current date.

```php
use RalphJSmit\Helpers\Laravel\Models\Casts;

class Something extends Model
{
    protected $casts = [
        'time' => TimeCast::class,
    ];
};
```

#### Smart factory name guessing with `HasFactory`

You can use the new `HasFactory` trait to automatically guess the name of your factories. This optimized factory trait can also guess the name of factories in different namespaces than `App\Models`, like `Support\.

```php
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Helpers\Laravel\Concerns\HasFactory;

class MyModel extends Model 
{
    use HasFactory;
}
```

If you prefer or need to define the factory class yourself, you may also use the `protected $factory` property to define your factory:

```php
class MyModel extends Model 
{
    use HasFactory;
    
    protected $factory = MyModelFactory::class;
}
```

## Livewire

### CanBeRefreshed trait

You may use the `CanBeRefreshed` trait to automatically register the following event:

```php
use RalphJSmit\Helpers\Livewire\CanBeRefreshed;

class MyComponent extends Component
{
    use CanBeRefreshed;
    
    // Will register the following event and listener:
    // [ '$refresh' => '$refresh', ]
    
    // Registering additional listeners is no problem:
    protected $listeners = [
        /* Your other listeners */
    ];
}
```

### RegisterListeners trait

You may use the `RegisterListeners` trait to dynamically register event listeners, for example from the `mount()` or `initialized()` methods:

```php
use RalphJSmit\Helpers\Livewire\RegisterListeners;

// Somewhere...
$this->registerListeners([
    'my-event' => 'myListener'
]);
```

### RegisterMessages trait

You may use the `RegisterMessages` trait to dynamically register event listeners, for example from the `mount()` or `initialized()` methods:

```php
use RalphJSmit\Helpers\Livewire\RegisterMessages;

// Somewhere...
$this->registerMessages([
    'user.email.required' => 'Adding an e-mail address is required.'
]);
```

## General

🐞 If you spot a bug, please submit a detailed issue and I'll try to fix it as soon as possible.

🔐 If you discover a vulnerability, please review [our security policy](../../security/policy).

🙌 If you want to contribute, please submit a pull request. All PRs will be fully credited. If you're unsure whether I'd accept your idea, feel free to contact me!

🙋‍♂️ [Ralph J. Smit](https://ralphjsmit.com)
