<?php

echo Yii::$app->user->identity->username;

?>

<a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit']) ?>" class="btn btn-success">Редактировать профиль</a><br>
<br><br>
<a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit-phone']) ?>" class="btn btn-default">Редактировать телефон</a>
<br><br><br>

<?php


if ($model->phone && $model->phone_verified == 0) {
    ?>
    <a href="<?= \yii\helpers\Url::to(['cabinet/profile/phone-verified']) ?>" class="btn btn-danger">Подтвердить телефон</a>
    <?php
}
?>

