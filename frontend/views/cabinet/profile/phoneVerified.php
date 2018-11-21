<?php

use yii\widgets\ActiveForm;

?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'code')->input('text')->label('Код'); ?>

            <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-primary']); ?>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>