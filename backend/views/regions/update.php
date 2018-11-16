<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model board\entities\Regions */

$this->title = 'Обновить регион: ' . $region->name;
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $region->name, 'url' => ['view', 'id' => $region->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="regions-update">

    <div class="regions-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label('Слаг') ?>

        <?= $form->field($model, 'parent_id')->textInput()->label('Id родителя') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
