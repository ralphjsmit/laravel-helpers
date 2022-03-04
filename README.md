# A package containing handy helpers for your Laravel-application.

This package contains a set of handy helpers for your Laravel-application.

## Installation

You can install the package via composer:

```bash
composer require ralphjsmit/laravel-helpers
```

## Laravel

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
