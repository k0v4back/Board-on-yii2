<?php

use kartik\form\ActiveForm;

?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'phone')->input('text'); ?>

            <?= \yii\helpers\Html::submitButton('Обновить', ['class' => 'btn btn-primary']); ?>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
