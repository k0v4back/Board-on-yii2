<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <p>Нажмите если точно уверены что хотите подтвердить свой телефон</p>
            <a href="<?= Url::to(['cabinet/profile/phone-verified']) ?>" type="button" class="btn btn-primary"> Продолжить </a>
        </div>
    </div>
</div>