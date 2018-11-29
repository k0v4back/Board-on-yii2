<?php

use yii\widgets\Breadcrumbs;


$this->params['breadcrumbs'][] = [
    'label' => 'Кабинет', // название ссылки
    'url' => ['/cabinet/profile/index', 'id' => Yii::$app->user->getId()] // сама ссылка
];
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь'];
?>

<h3>Обратная связь</h3>
<a href="<?= \yii\helpers\Url::to(['/cabinet/ticket/create', 'user_id' => Yii::$app->user->getId()]) ?>" class="btn btn-primary">Содать новое обращение</a>




<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($tickets as $ticket) : ?>
            <div style="padding: 10px; border: 1px solid black; border-radius: 5px; margin: 10px" class="col-md-4">
                <h4><a href="<?= \yii\helpers\Url::to(['/cabinet/ticket/messages', 'ticket' => $ticket->id]) ?>"><?= $ticket->subject . '</br>'; ?></h4></a>
                <p><?= date("G:i:s d-m-Y", $ticket->created_at) ?></p>
                <a href="<?= \yii\helpers\Url::to(['/cabinet/ticket/messages', 'ticket' => $ticket->id]) ?>" class="btn btn-primary" style="float: right">Перейти</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
