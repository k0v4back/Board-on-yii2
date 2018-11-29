<?php

use yii\widgets\ActiveForm;
use board\helpers\HistoryHelper;
use board\entities\ticket\Status;

//var_dump($lastHistory->status);die();
?>

<a href="<?= \yii\helpers\Url::to(['cabinet/ticket/index', 'user_id' => Yii::$app->user->getId()]) ?>" class="btn btn-success">Назад</a><br><br>

<?php if($lastHistory->status === \board\entities\ticket\Status::CLOSED) : ?>
    <div class="alert alert-danger">
        Это обращени закрыто!
    </div>
<?php endif; ?>

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
        <div class="col-lg-6 col-md-6 col-sm-6" style="border: 1px solid #DDDDDD; border-radius: 5px">
            <h3>История</h3>
            <?php foreach ($history as $status): ?>
            <div >
                <div>
                    <?= HistoryHelper::statusLabel($status->status) ?> <?= date("G:i:s d-m-Y", $status->created_at) ?><br><br>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<br>
<br>

<?php if($lastHistory->status == Status::OPEN || $lastHistory->status == Status::APPROVED) : ?>
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
<?php endif; ?>
<?php if($lastHistory->status === \board\entities\ticket\Status::CLOSED) : ?>
    <div>
        <h3>Вы не можете отправлять сообщения, потому что это обращение закрыто</h3>
    </div>
<?php endif; ?>
