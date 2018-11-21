<?php

echo Yii::$app->user->identity->username;

?>

<a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit']) ?>" class="btn btn-success">Редактировать профиль</a><br>
<br><br>
<a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit-phone']) ?>" class="btn btn-default">Редактировать телефон</a>
<br><br><br>

<?php


if($user->isPhoneVerified() && $model->phone_verified_token_expire == null){
    ?>
        <a href="<?= \yii\helpers\Url::to(['cabinet/profile/code']) ?>" class="btn btn-danger">Подтвердить телефон</a>
    <?php
}elseif($user->isPhoneVerified() && $model->phone_verified_token_expire == null){
    ?>
        <h4>Телефон: <i><?= $model->phone ?></i> успешно подтверждён!</h4>
    <?php
}

if (time() > $model->phone_verified_token_expire && $model->phone_verified == 0){
    ?>
        <a href="<?= \yii\helpers\Url::to(['cabinet/profile/code']) ?>" class="btn btn-danger">Подтвердить телефон</a>
    <?php
}elseif(time() < $model->phone_verified_token_expire && $model->phone_verified == 0){
    $expire = $model->phone_verified_token_expire - time();
    echo " Вам нужно подождать " . $expire . " cекунды для того чтобы повторить попытку подтверждыения телефона" ;
}else{
    ?>
    <h4>Телефон: <i><?= $model->phone ?></i> успешно подтверждён!</h4>
    <?php
}

?>




