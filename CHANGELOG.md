# Changelog

All notable changes to `laravel-helpers` will be documented in this file.

## 1.4.1 - 2022-05-03

- Add PhpStorm/Psalm autocompletion for `->pipeInto()` method

## 1.4.0 - 2022-04-30

- Add `Pipe`, `pipe()`
- Add `Pipeable`
- Add `pipeline()`

## 1.3.0 - 2022-04-04

- Accept `$timezone` parameter in `yesterday()` and `tomorrow()` helpers.

## 1.2.0 - 2022-03-04

- Add `daysOfMonth()` helper

## 1.1.3 - 2022-02-19

- Receive `$timezone` as second parameter in `carbon()` and `carbonDate()`

## 1.1.2 - 2022-02-17

- Update `HasFactory` to use `self` instead of `static`, because this could refer to the wrong model when extending the original model.

## 1.1.1 - 2022-02-10

- Remove accidental dependency

## 1.1.0 - 2022-02-10

- Feat: add `tomorrow()` and `yesterday()` helpers for Carbon
- Fix: remove dump from test
- Feat: add Laravel 9 support

## 1.0.0 - 2022-02-10

- Initial release!

## 1.0.0 - 202X-XX-XX

- initial release
