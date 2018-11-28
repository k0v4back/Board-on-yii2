<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-index">

    <p>
        <?= Html::a('Создать объявление', ['create'], ['class' => 'btn btn-success']) ?>
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
                            'attribute' => 'user',
                        'label' => 'Пользователь',
                        'value' => 'user.username'
                    ],
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок',
                    ],
                    [
                        'attribute' => 'price',
                        'label' => 'Цена',
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Статус',
                        'filter' => \board\helpers\AdvertHelper::statusList(),
                        'value' => function (\board\entities\Advert $user) {
                            return \board\helpers\AdvertHelper::statusLabel($user->status);
                        },
                        'format' => 'raw',
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
