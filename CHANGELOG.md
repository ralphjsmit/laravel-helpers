# Changelog

All notable changes to `laravel-helpers` will be documented in this file.

## 1.8.0 - 2023-08-03

- Update Livewire trait convention

## 1.7.0 - 2023-02-17

- Add Laravel 10 support in #10

## 1.6.0 - 2022-11-21

- Add `BooleanAsTimestampCast`
- Add factory `resolveRelationshipUsing()` method

## 1.5.0 - 2022-05-12

– Add Eloquent `TimeCast` cast to cast values into timestamps like "08:30:00".

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
