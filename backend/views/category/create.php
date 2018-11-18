<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use board\helpers\ListHelper;

/* @var $this yii\web\View */
/* @var $model board\entities\Category */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="category-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label('Слаг') ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание') ?>

        <?= $form->field($model, 'parentId')->dropDownList(ListHelper::parentCategoriesList())->label('Родительская категория') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
