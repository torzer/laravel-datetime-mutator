# laravel-datetime-mutator

Laravel traits mutators to help Date Time manipulation on Eloquent Models.

## Installing

```
composer require torzer/laravel-datetime-mutator
```

## Traits


### MapDateTimeMutator

The `MapDateTimeMutator` trait is used to set a date and time mutator (only date or time if necessary)
related to a specific input format.

WHen using this trait it's not necessary to implement a  _setVariavelAttribute($value)_ mutator to transform a date from a format to another,
as for example from **d/m/Y** format of a string or object to another that will be used to persist the date in database.

To use it, set in the class:

```php
<?php

use Torzer\Common\Traits\MapDateTimeMutator;

class MyClass extends Model {

    use MapDateTimeMutator;
..
```