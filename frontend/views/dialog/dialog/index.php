<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>


<h4>Hello, it is room for dialog with owner of advert</h4>


<div class="row">
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'message')->label('Сообщение') ?>

        <div class="form-group">
            <?= Html::submitButton('Написать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>