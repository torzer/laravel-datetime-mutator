<?php

use Illuminate\Database\Eloquent\Model;

use Torzer\Common\Traits\MapDateTimeMutator;

class DateTimeModel extends Model
{

    use MapDateTimeMutator;

    protected $dates = ['ignored_at', 'started_at', 'finished_at'];

    protected $mapDateTimeMutator = [
        'started_at' => [
            'from' => 'd/m/Y',
            'to' => 'Y-m-d'
        ],
    ];

}
