<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model board\entities\Advert */

$this->title = 'Update Advert: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="advert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->input('text')->label('Title') ?>

    <!--    --><?//= $form->field($model, 'status')->dropDownList(\board\helpers\ListHelper::advertStatus())->label('Статус объявления') ?>
    <?= $form->field($model, 'status')->input('text')->label('Статус объявления') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
