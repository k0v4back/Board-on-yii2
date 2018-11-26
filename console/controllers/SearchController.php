<?php

namespace console\controllers;

use board\entities\Advert;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class SearchController extends Controller
{
    private $client;

    public function __construct($id, $module, Client $client, $config = [])
    {
        $this->client = $client;
        parent::__construct($id, $module, $config);
    }

    public function actionReindex()
    {
        $query = Advert::find()->orderBy('id');

        $this->stdout('Clearing' . PHP_EOL);

        try {
            $this->client->indices()->delete(['index' => 'board']);
        } catch (Missing404Exception $e) {
            $this->stdout('Index is empty' . PHP_EOL);
        }
        $this->stdout('Creating of index' . PHP_EOL);

        foreach ($query->each() as $advert){
            $this->stdout('Advert #' . $advert->id . PHP_EOL);

//            Индексируем объявления

            //curl -XGET 'http://localhost:9200/board/advert/1/?pretty&_source=false'

            $this->client->index([
                'index' => 'board',
                'type' => 'advert',
                'id' => $advert->id,
                'body' => [
                    'category_id' => (int)$advert->category_id,
                    'region_id' => (int)$advert->region_id,
                    'title' => strip_tags($advert->title),
                    'content' => strip_tags($advert->content),
                ]
            ]);
        }
        $this->stdout('Done!' . PHP_EOL);
    }
}