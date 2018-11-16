<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model board\entities\Regions */

$this->title = 'Создать регионы';
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-create">

    <div class="regions-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label('Слаг') ?>

        <?=
        $form->field($model, 'parent_id')->dropDownList($data, ['prompt'=>''])->label('К какому региону/краю привязать');
        ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
