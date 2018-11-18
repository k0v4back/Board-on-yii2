<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use board\helpers\ListHelper;

/* @var $this yii\web\View */
/* @var $model board\entities\Category */

$this->title = 'Обновить категорию: ' . $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="category-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label('Слаг') ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание') ?>

        <?= $form->field($model, 'parentId')->dropDownList(ListHelper::parentCategoriesList())->label('Родительская категория') ?>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
