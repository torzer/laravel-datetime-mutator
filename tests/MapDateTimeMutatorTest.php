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
        $model->created_at = \Carbon\Carbon::now();

        echo "Model in MapDateTimeMutator Test";
        dump($model->started_at);
        dump($model->created_at);

    }

    public function testDeafultDateTimeMutatorMongoDBFromDMYtoYMD()
    {

        $model = new DateTimeMongoModel();

        $model->started_at = '20/10/2017';

        echo "Mongo Model in MapDateTimeMutator Test";
        dump($model->started_at);

    }
}
