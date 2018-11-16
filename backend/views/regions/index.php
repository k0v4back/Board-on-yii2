<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\RegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Регионы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-index">

    <?php $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => $query,
        'pagination' => [ 'pageSize' => 20 ],
    ]); ?>

    <p>
        <?= Html::a('Создать регион', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-info">
        <div class="box-body" style="overflow-y: hidden">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'id',
                        'label' => 'Идентификатор',
                    ],
                    [
                        'attribute' => 'name',
                        'label' => 'Имя',
                        'value' => function ($searchModel) {
                            return Html::a(Html::encode($searchModel->name), \yii\helpers\Url::to(['view', 'id' => $searchModel->id]));
                        },
                        'format' => 'raw',

                    ],
                    [
                        'attribute' => 'slug',
                        'label' => 'Слаг',
                    ],
                    [
                        'attribute' => 'parent_id',
                        'label' => 'Родительский идентификатор',
                        'value' => function ($searchModel) {
                            if(!$searchModel->parent_id){
                                return '<b>пустой</b>, это регион';
                            }
                        },
                        'format' => 'raw',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
