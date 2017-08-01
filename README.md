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

Set the date fields as you would do in _array $dates_, but to those dates or timestamps that need to be transformed
from one format to another, use the array `$mapDateTimeMutator` with the
name of the date field as the array key and an array mapping `from` and `to` formats:

```php
<?php

use Torzer\Common\Traits\MapDateTimeMutator;

class MyClass extends Model {

    use MapDateTimeMutator;

    protected $mapDateTimeMutator = [
        'start_date' => ['from' => 'd/m/Y', 'to' => 'Y-m-d'],
        'finish_date' => ['from' => 'd/m/Y', 'to' => 'Y-m-d']
    ];

    protected $dates = [
        'approved_at', 'start_date', 'finish_date'
    ];

    ...


```

At the example above, the fields `start_date` and `finish_date` gonna be handle with the DateTime function of Laravel Eloquent Model,
but they arecreated from format `d/m/Y` set in `from` key of the `$mapDateTimeMutator` array,
getting as return/setAttribute of the field a string formated using the `to` key.

The `approved_at` field in `$dates` array is still handled with the default behavior of the framework.

**Note** that the input value of this fields - `start_date` and `finish_date`, must be in `d/m/Y` format.
