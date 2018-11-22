<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use board\helpers\ListHelper;

?>


<div class="row">
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->label('Заголовок объявления') ?>

        <?= $form->field($model, 'price')->label('Цена') ?>

        <?= $form->field($model, 'content')->label('Описание') ?>

        <?= $form->field($model, 'address')->label('Адрес') ?>

        <?= $form->field($model, 'region_id')->dropDownList(ListHelper::region())->label('Ваш регион') ?>

        <?= $form->field($model, 'category_id')->dropDownList(ListHelper::category())->label('Категоря объявления') ?>


        <div class="form-group">
            <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>
