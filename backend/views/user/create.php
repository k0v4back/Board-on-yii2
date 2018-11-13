<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true])->label('Имя') ?>
    <?= $form->field($model, 'email')->textInput(['maxLength' => true])->label('Почта') ?>
    <?= $form->field($model, 'password')->passwordInput(['maxLength' => true])->label('Пароль') ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>