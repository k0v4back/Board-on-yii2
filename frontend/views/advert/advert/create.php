<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use board\helpers\ListHelper;
use kartik\select2\Select2;
use dosamigos\fileupload\FileUpload;

?>


<div class="row">
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->label('Заголовок объявления') ?>

        <?= $form->field($model, 'price')->label('Цена') ?>

        <?= $form->field($model, 'content')->label('Описание') ?>

        <?= $form->field($model, 'address')->label('Адрес') ?>

        <?= $form->field($model, 'region_id')->widget(Select2::class, [
            'data' => ListHelper::region(),
            'language' => 'ru',
            'options' => ['placeholder' => 'Введите регион'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Ваш регион');
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


        <?= FileUpload::widget([
            'model' => $pictureUpload,
            'attribute' => 'image',
            'url' => ['advert/advert/picture'],
            'options' => ['accept' => 'image/*'],
            'clientOptions' => [
                'maxFileSize' => 100000000
            ],
            'clientEvents' => [
                'fileuploaddone' => 'function(e, data) {
                      if (data.result.success) {
                          $("#profile-image-success").show();
                          $("#profile-image-fail").hide();
                          $("#profile-picture").attr("src", data.result.pictureUri);
                        } else {
                          $("#profile-image-fail").html(data.result.errors.picture).show();
                          $("#profile-image-success").hide();
                        }
                      }',
            ],
        ]); ?>

        <div class="alert alert-success display-none" id="profile-image-success">Фотография загружена.</div>
        <div class="alert alert-danger display-none" id="profile-image-fail"> Возникла ошибка, фотография болжна быть определённого расширения и не больше 5 мегабайт </div>

        <div class="form-group">
            <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>
