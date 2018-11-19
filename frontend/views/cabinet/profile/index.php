<?php

echo Yii::$app->user->identity->username;

?>

<a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit']) ?>" class="btn btn-success">Редактировать профиль</a>

