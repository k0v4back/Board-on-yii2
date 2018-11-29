<?php

use yii\widgets\ActiveForm;

?>

<a href="<?= \yii\helpers\Url::to(['cabinet/ticket/index', 'user_id' => Yii::$app->user->getId()]) ?>" class="btn btn-success">Назад</a><br><br>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div style="background-color: #DDDDDD; border-radius: 5px; overflow: scroll; height: 450px;" class="col-md-12">
                <h4>Ваш диалог с админом:</h4>
                <hr>
                <?php if($messages == null) : ?>
                    <h3 style="text-align: center;">Диалог пуст</h3>
                <?php endif; ?>
                <?php foreach ($messages as $message) : ?>


                    <?php $user = \frontend\controllers\cabinet\TicketController::user($message->user_id); ?>

                    <?php if ($message->user_id != Yii::$app->user->getId()) : ?>
                        <div style="margin: 10px; border-radius: 5px; background-color: white; padding: 5px; float: left" class="col-md-6">
                            Имя: <b><?= $user[0]['username']; ?></b>
                            <text style="float: right"><?= date("G:i:s d-m-Y", $message->created_at) ?></text>
                            <br>
                            <a style="text-decoration: none"><?= $message->content ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if ($message->user_id == Yii::$app->user->getId()) : ?>
                        <div style="margin: 10px; border-radius: 5px; background-color: white; padding: 5px; float: right" class="col-md-6">
                            <text style="float: right"><?= date("G:i:s d-m-Y", $message->created_at) ?></text>
                            Имя: <b><?= $user[0]['username']; ?></b><br>
                            <a style="text-decoration: none"><?= $message->content ?></a>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<br>
<br>


<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'content')->input('text')->textarea()->label('Сообщение'); ?>

            <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-default']); ?>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
