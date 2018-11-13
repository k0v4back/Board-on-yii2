<?php

/* @var $this yii\web\View */
/* @var $model board\entities\User */

$this->title = 'Обновить данные: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="user-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
