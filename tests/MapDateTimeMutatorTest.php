<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Torzer\Common\Traits\MapDateTimeMutator;

class MapDateTimeMutatorTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->app->setLocale('pt-BR');
        Config::set('app.timezone', 'America/Sao_Paulo');
    }

    public function testDeafultDateTimeMutatorFromDMYtoYMD()
    {

        $model = new DateTimeModel();

        $model->started_at = '20/10/2017';

        $date = \Carbon\Carbon::createFromFormat('d/m/Y', '20/10/2017', 'UTC')->setTime(0, 0, 0);


        $this->assertEquals($date, $model->started_at);
    }

    public function testDeafultDateTimeMutatorMongoDBFromDMYtoYMD()
    {

        $model = new DateTimeMongoModel();

        $model->started_at = '20/10/2017';

        $date = \Carbon\Carbon::createFromFormat('d/m/Y', '20/10/2017', 'UTC')->setTime(0, 0, 0);


        $this->assertEquals($date, $model->started_at);
    }
}
