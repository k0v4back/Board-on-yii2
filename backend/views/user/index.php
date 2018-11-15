<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $query backend\controllers\ */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => $query,
        'pagination' => [ 'pageSize' => 20 ],
    ]);

    ?>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'attribute' => 'username',
                        'label' => 'Имя',
                    ],
                    [
                        'attribute' => 'email',
                        'label' => 'Почта',
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Дата регистрации',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date_from',
                            'attribute2' => 'date_to',
                            'type' => DatePicker::TYPE_RANGE,
                            'separator' => '-',
                            'pluginOptions' => [
                                'todayHighlight' => true,
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                            ],
                        ]),
                        'format' => 'datetime',
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Статус',
                        'filter' => \board\helpers\UserHelper::statusList(),
                        'value' => function (\board\entities\User $user) {
                            return \board\helpers\UserHelper::statusLabel($user->status);
                        },
                        'format' => 'raw',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
<?php

