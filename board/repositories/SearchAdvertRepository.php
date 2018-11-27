<?php

namespace board\repositories;

use board\entities\Advert;
use board\entities\Category;
use board\forms\search\SearchForm;
use Elasticsearch\Client;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class SearchAdvertRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(SearchForm $form)
    {

        $categoryIds = Category::findOne(['id' => $form->category]);
        $query = Advert::find()->where(['status' => Advert::STATUS_ACTIVE]);

        if($category = $form->category){
            $categoryIds = ArrayHelper::merge([$form->category], $categoryIds->getChildren()->select('id')->column());
            $query->andWhere(['category_id' => $categoryIds]);
        }

        $query->andFilterWhere(['like', 'content', $form->content])
            ->andFilterWhere(['like', 'title', $form->title])
            ->andFilterWhere(['like', 'region_id', $form->region])
            ->orderBy(['id' => SORT_DESC])
            ->all();
        return $query->all();


        //ElasticSearch
//        $pagination = new Pagination([
//            'pageSizeLimit' => [15, 100],
//            'validatePage' => false,
//        ]);
//        $sort = new Sort([
//            'defaultOrder' => ['id' => SORT_DESC],
//            'attributes' => [
//                'id',
//                'category_id',
//                'region_id',
//                'title',
//                'content',
//            ],
//        ]);
//
//
//        $query = [
//            'multi_match' => [
//                'query' => $form->content,
//                'fields' => ['title^3', 'content'],
//            ],
//        ];
//
//        $parameters = [
//            'index' => 'board',
//            'type' => 'advert',
//            'body' => [
//                'from' => $pagination->getOffset(),
//                'size' => $pagination->getLimit(),
//                'query' => [
//                    'bool' => [
//                        'must' => array_merge(
//                            ['multi_match' => [
//                                'query' => $form->content,
//                                'fields' => ['title^3', 'content'],
//                            ]],
//                            ['multi_match' => [
//                                'query' => $form->region,
//                                'fields' => ['region_id'],
//                            ]],
//                            ['multi_match' => [
//                                'query' => $form->category,
//                                'fields' => ['category_id'],
//                            ]]
//                        ),
//                    ],
//                ],
//        ],
//
//
//        ];
//        $response = $this->client->search($parameters);
//
//
//        $ids = ArrayHelper::getColumn($response['hits']['hits'], '_source.id');
//
//        if ($ids) {
//            $query = Advert::find()
//                ->andWhere(['id' => $ids])
//                ->orderBy(new Expression('FIELD(id,' . implode(',', $ids) . ')'))
//                ->all();
//        } else {
//            $query = Advert::find()->andWhere(['id' => 0])->all();
//        }
//        return $query;


    }


}