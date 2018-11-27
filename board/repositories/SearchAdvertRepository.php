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

//        $categoryIds = Category::findOne(['id' => $form->category]);
//        $query = Advert::find()->where(['status' => Advert::STATUS_ACTIVE]);
//
//        if($category = $form->category){
//            $categoryIds = ArrayHelper::merge([$form->category], $categoryIds->getChildren()->select('id')->column());
//            $query->andWhere(['category_id' => $categoryIds]);
//        }
//
//        $query->andFilterWhere(['like', 'content', $form->content])
//            ->andFilterWhere(['like', 'title', $form->title])
//            ->andFilterWhere(['like', 'region_id', $form->region])
//            ->orderBy(['id' => SORT_DESC])
//            ->all();
//        return $query->all();


//        $params = array();
//        $params['index'] = 'board';
//        $params['type'] = 'advert';
//        $params['id'] = $form->category;
//
//        $result = $this->client->get($params);
//
////        var_dump($result);die();
//
////        echo '<pre>';
////        print_r($result);
////        echo '</pre>';
////
////        echo $result['_source']['title'];
////        die();
//
//        $data = array();
//
//        $data['content'] = $result['_source']['content'];
//        $data['title'] = $result['_source']['title'];
//        $data['region_id'] = $result['_source']['region_id'];
//        $data['id'] = $result['_source']['id'];
//
//
//        return $data;
//





        $pagination = new Pagination([
            'pageSizeLimit' => [15, 100],
            'validatePage' => false,
        ]);
        $sort = new Sort([
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'id',
                'category_id',
                'region_id',
                'title',
                'content',
            ],
        ]);



//        $response = $this->client->search([
//            'index' => 'board',
//            'type' => 'advert',
//            'body' => [
////                '_source' => ['id'],
//                'from' => $pagination->getOffset(),
//                'size' => $pagination->getLimit(),
////                'sort' => array_map(function ($attribute, $direction) {
////                    return [$attribute => ['order' => $direction === SORT_ASC ? 'asc' : 'desc']];
////                }, array_keys($sort->getOrders()), $sort->getOrders()),
//                'query' => [
//                    'bool' => [
//                        'must' => [
//                            ['term' => ['categories' => $form->category]],
//                            ['term' => ['content' => $form->content]],
//                            ['multi_match' => [
//                                'query' => "Для",
//                                'fields' => ['content^3', 'categories']
//                            ]],
////                            ['nested' => [
////                                'path' => 'category_id',
////                                'query' => [
////                                    'bool' => [
////                                        'must' => [
////                                            ['match' => ['category_id']]
////                                        ],
////                                    ],
////                                ],
////                            ]],
//                        ],
//                    ],
//                ],
//            ],
//        ]);

//        var_dump($form->content);die();

        $query = [
            'multi_match' => [
//                'query' => 'Продам',
                'query' => $form->content,
                'fields' => ['title^3', 'content'],
            ],
        ];

        $parameters = [
            'index' => 'board',
            'type' => 'advert',
            'body' => [
                'query' => $query
            ]
        ];
        $response = $this->client->search($parameters);


        $ids = ArrayHelper::getColumn($response['hits']['hits'], '_source.id');

//        var_dump($response['hits']['hits']);die();

        if ($ids) {
            $query = Advert::find()
                ->andWhere(['id' => $ids])
                ->orderBy(new Expression('FIELD(id,' . implode(',', $ids) . ')'))
                ->all();
        } else {
//            $query = Advert::find()->andWhere(['id' => 0]);
            $query = Advert::find()->andWhere(['id' => 0])->all();
        }
//        return new ActiveDataProvider([
//            'query' => $query,
//            'totalCount' => $response['hits']['total'],
//            'pagination' => $pagination,
//            'sort' => $sort,
//        ]);



//        echo '<pre>';
//        print_r($query);
//        echo '</pre>';
//        die();
//        var_dump($response);die();

//        return $response['hits']['hits'];

        return $query;


    }





}