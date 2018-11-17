<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model board\entities\Regions */
/* @var $searchModel backend\search\RegionsDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $breadcrumbs \backend\controllers\RegionsController */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Регионы', 'url' => ['index']];
if($model->parent_id){
    $this->params['breadcrumbs'][] = ['label' => $breadcrumbs[$model->parent_id]['name'], 'url' => ['view', 'id' => $model->parent_id]];
}

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

    <?php

//    echo $model->parent_id;
//    die();
    ?>


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
    </div><br>


    <h3>
        Список населённых пунктов региона/округа - <?= $model->name ?>
    </h3>
    <p>
        <?= Html::a('Создать населённы пункт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
