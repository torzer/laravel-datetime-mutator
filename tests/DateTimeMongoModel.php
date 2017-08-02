<?php

use Jenssegers\Mongodb\Eloquent\Model;

use Torzer\Common\Traits\MapDateTimeMutator;

class DateTimeMongoModel extends Model
{

    use MapDateTimeMutator;

    protected $dates = ['ignored_at', 'started_at', 'finished_at'];

    protected $mapDateTimeMutator = [
        'started_at' => [
            'from' => 'd/m/Y',
            'to' => 'Y-m-d',
            'date-only' => true,
        ],
    ];

}
