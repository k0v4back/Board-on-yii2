<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-info">
        <div class="box-body" style="overflow-y: hidden">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (\board\entities\Category $model) {
                            $indent = ($model->depth > 1 ? str_repeat('&nbsp;&nbsp;', $model->depth - 1) . ' ' : '');
                            return $indent . Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    'slug',
                    'title',
                    'description:ntext',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
