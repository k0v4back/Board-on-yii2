<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model board\entities\Category */

$this->title = $model->name ? $model->name : 'Просмотр';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить эту категорию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'name',
                'label' => 'Имя',
            ],
            [
                'attribute' => 'slug',
                'label' => 'Слаг',
            ],
            [
                'attribute' => 'title',
                'label' => 'Заголовок',
            ],
            [
                'attribute' => 'description',
                'label' => 'Описание',
            ],
            [
                'attribute' => 'depth',
                'label' => 'Глубинак категории',
            ],
            [
                'attribute' => 'parentId',
                'label' => 'Id родительской категории',
            ],
        ],
    ]) ?>

</div>
