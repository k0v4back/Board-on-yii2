<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;


//var_dump($messages);die();
//var_dump($owner_id[0]['owner_id']);die();
//var_dump($dialog[0]['advert_id']);die();
//var_dump($advert);die();
//var_dump($photo[0]['name']);die();
?>
<div class="row">
    <div class="col-md-12" style="border: solid 1px black; padding: 10px; border-radius: 5px">
        <div class="col-md-3">
            <a href="<?= \yii\helpers\Url::to(['/advert/advert/show', 'id' => $advert->id]) ?>"><img src="<?= Yii::$app->params['storageUri'] . $photo[0]['name'] ?>" style="width: 150px; height: 150px"></a>
        </div>
        <div class="col-md-9">
            <a href="<?= \yii\helpers\Url::to(['/advert/advert/show', 'id' => $advert->id]) ?>"><h4><?= $advert->title ?></h4></a>
            <p><?= strip_tags($advert->content) ?></p>
        </div>
    </div>
</div>
<br>


<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div style="background-color: #DDDDDD; border-radius: 5px; overflow: scroll; height: 450px;" class="col-md-12">
                <?php foreach ($messages as $message) : ?>
                    <?php if($message->user_id == Yii::$app->user->getId()) : ?>

                        <div style="margin: 10px; border-radius: 5px; background-color: #A0CEFF; padding: 5px; float: right" class="col-md-6">
                            <text style="float: right"></text>
                            Имя: <b>Name</b><br>
                            <a style="text-decoration: none"><?= $message->message ?></a>
                        </div>

                    <?php endif; ?>

                    <?php if($message->user_id != Yii::$app->user->getId()) : ?>

                        <div style="margin: 10px; border-radius: 5px; background-color: white; padding: 5px; float: left" class="col-md-6">
                            <text style="float: right"></text>
                            Имя: <b>Name</b><br>
                            <a style="text-decoration: none"><?= $message->message ?></a>
                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<br>
<br>


<div class="row">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'message')->label('Сообщение') ?>

        <div class="form-group">
            <?= Html::submitButton('Написать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>