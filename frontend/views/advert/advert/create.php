<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use board\helpers\ListHelper;
use kartik\select2\Select2;

?>


<div class="row">
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->label('Заголовок объявления') ?>

        <?= $form->field($model, 'price')->label('Цена') ?>

        <?= $form->field($model, 'content')->textarea()->label('Описание') ?>

        <?= $form->field($model, 'address')->label('Адрес') ?>

        <?= $form->field($model, 'region_id')->widget(Select2::class, [
            'data' => ListHelper::region(),
            'language' => 'ru',
            'options' => ['placeholder' => 'Введите регион'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Регион');
        ?>

        <?= $form->field($model, 'city')->widget(Select2::class, [
            'data' => ListHelper::city(),
            'language' => 'ru',
            'options' => ['placeholder' => 'Введите регион'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Город');
        ?>

        <?= $form->field($model, 'category_id')->widget(Select2::class, [
            'data' => ListHelper::category(),
            'language' => 'ru',
            'options' => ['placeholder' => 'Введите категорию'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Категория объявления');
        ?>


        <div class="form-group">
            <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>
