<?php


use yii\widgets\ActiveForm;
use board\helpers\ListHelper;

?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'category_id')->widget(\kartik\widgets\Select2::class, [
                'data' => ListHelper::category(),
                'language' => 'ru',
                'options' => ['placeholder' => 'Введите категорию'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Категория объявления');
            ?>

            <?= $form->field($model, 'region_id')->widget(\kartik\widgets\Select2::class, [
                'data' => ListHelper::region(),
                'language' => 'ru',
                'options' => ['placeholder' => 'Введите регион'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Регион');
            ?>

            <?= $form->field($model, 'city')->widget(\kartik\widgets\Select2::class, [
                'data' => ListHelper::city(),
                'language' => 'ru',
                'options' => ['placeholder' => 'Введите регион'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Город');
            ?>

            <?= $form->field($model, 'title')->input('text')->label('Заголовок'); ?>

            <?= $form->field($model, 'price')->input('text')->label('Цена'); ?>

            <?= $form->field($model, 'address')->input('text')->label('Адрес'); ?>

            <?= $form->field($model, 'content')->widget(\dosamigos\ckeditor\CKEditor::class, [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ])->label('Текст') ?>

            <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>



