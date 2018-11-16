<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model board\entities\Regions */
/* @var $searchModel backend\search\RegionsDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить этот регион?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-info">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'slug',
                    'parent_id',
                ],
            ]) ?>
        </div>
    </div>


    <div class="box box-info">
        <div class="box-body" style="overflow-y: hidden">
            <?= GridView::widget([
                'dataProvider' => $dataDetailProvider,
                'filterModel' => $searchDetailModel,
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
