<?php

use yii\widgets\ActiveForm;

?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'subject')->input('text'); ?>

            <?= $form->field($model, 'content')->input('text'); ?>

            <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-default']); ?>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
