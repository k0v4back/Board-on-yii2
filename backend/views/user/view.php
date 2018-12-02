<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model board\entities\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'label' => 'Роль',
                'class' => \board\helpers\HelperRole::class,
                'filter' => \yii\helpers\ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'),
                'attribute' => 'role',
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
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
