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
                    ],
                    [
                        'attribute' => 'slug',
                        'label' => 'Слаг',
                    ],
                    [
                        'attribute' => 'parent_id',
                        'label' => 'Родительский идентификатор',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
