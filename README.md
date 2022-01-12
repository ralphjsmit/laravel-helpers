# A package containing handy helpers for your Laravel-application.

This package contains a set of handy helpers for your Laravel-application.

## Installation

You can install the package via composer:

```bash
composer require ralphjsmit/laravel-helpers
```

## Laravel

### Eloquent

#### Smart factory name guessing with `HasFactory`

You can use the new `HasFactory` trait to automatically guess the name of your factories. This optimized factory trait can also guess the name of factories in different namespaces than `App\Models`.

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

## General

🐞 If you spot a bug, please submit a detailed issue and I'll try to fix it as soon as possible.

🔐 If you discover a vulnerability, please review [our security policy](../../security/policy).

🙌 If you want to contribute, please submit a pull request. All PRs will be fully credited. If you're unsure whether I'd accept your idea, feel free to contact me!

🙋‍♂️ [Ralph J. Smit](https://ralphjsmit.com)
