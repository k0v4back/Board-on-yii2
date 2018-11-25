<?php

/* @var $this yii\web\View */

$this->title = 'Поиск';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $form = \yii\widgets\ActiveForm::begin(['action' => [''], 'method' => 'get']) ?>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($searchForm, 'content')->textInput()->label('Описание') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($searchForm, 'region')->widget(\kartik\select2\Select2::class, [
                        'data' => \board\helpers\ListHelper::region(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Введите регион'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Регион');
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($searchForm, 'category')->widget(\kartik\select2\Select2::class, [
                        'data' => \board\helpers\ListHelper::category(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Введите регион'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Категория');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= \yii\helpers\Html::submitButton('Поиск', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>
                <div class="col-md-6">
                    <?= \yii\helpers\Html::a('Очистить форму поиска', [''], ['class' => 'btn btn-default btn-lg btn-block']) ?>
                </div>
            </div>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>
    </div>

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-12">

            <?php foreach ($dataProvider as $data) : ?>
            <div class="col-md-3 hero-feature">
                <div class="thumbnail">
                    <?php
                    $photo = \board\entities\Photo::find()->where(['advert_id' => $data->id])->one();
                    ?>
                    <a href="<?= \yii\helpers\Url::to(['advert/advert/show', 'id' => $data->id]) ?>"><img src="<?= Yii::$app->params['storageUri'] . $photo->name ?>"></a>
                    <div class="caption">
                        <h3><?= $data->title ?></h3>
                        <p><?= substr($data->content, 0, 50) ?></p>
                        <p>
                            <a href="<?= \yii\helpers\Url::to(['advert/advert/show', 'id' => $data->id]) ?>" class="btn btn-default">Смотреть подробнее</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

