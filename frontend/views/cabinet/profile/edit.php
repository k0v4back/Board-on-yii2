<?php


use yii\widgets\ActiveForm;

?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->input('text'); ?>

            <?= $form->field($model, 'last_name')->input('text'); ?>

            <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>



