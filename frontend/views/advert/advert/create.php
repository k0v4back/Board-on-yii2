<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

//var_dump($model);die();

?>


<div class="row">
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'category_id') ?>

        <?= $form->field($model, 'title') ?>

        <?= $form->field($model, 'price') ?>

        <?= $form->field($model, 'content') ?>

        <?= $form->field($model, 'address') ?>

        <?= $form->field($model, 'region_id') ?>

        <div class="form-group">
            <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>
