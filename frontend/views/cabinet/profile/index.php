<?php

echo Yii::$app->user->identity->username;

?>

<a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit']) ?>" class="btn btn-success">Редактировать профиль</a><br>
<br><br>
<a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit-phone']) ?>" class="btn btn-default">Редактировать телефон</a>
<br><br><br>

<?php


if($user->isPhoneVerified() && $model->phone_verified_token_expire == null && $model->phone && $model->phone_verified != 1){
    ?>
        <a href="<?= \yii\helpers\Url::to(['cabinet/profile/code']) ?>" class="btn btn-danger">Подтвердить телефон</a>
    <?php
}elseif($user->isPhoneVerified() && $model->phone_verified_token_expire == null && $model->phone){
    ?>
        <h4>Телефон: <i><?= $model->phone ?></i> успешно подтверждён!</h4>
    <?php
}

if (time() > $model->phone_verified_token_expire && $model->phone_verified_token_expire != null && $model->phone_verified == 0 && $model->phone){
    ?>
        <a href="<?= \yii\helpers\Url::to(['cabinet/profile/code']) ?>" class="btn btn-danger">Подтвердить телефон</a>
    <?php
}elseif(time() < $model->phone_verified_token_expire && $model->phone_verified == 0){
    $expire = $model->phone_verified_token_expire - time();
    echo " Вам нужно подождать " . $expire . " cекунды для того чтобы повторить попытку подтверждыения телефона" ;
}elseif($model->phone_verified_token == 1){
    ?>
    <h4>Телефон: <i><?= $model->phone ?></i> успешно подтверждён!</h4>
    <?php
}

?>


<style>
    .load {
        margin: 20px;
    }

    .data-user {
        margin-top: 10px;
    }

</style>


<div class="row">
    <div class="col-lg-2 col-md-6 col-sm-6">
        <img src="http://placehold.it/180x180" alt="140x140" class="img-rounded"><button class="btn btn-primary load">Загрузиить фото</button>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 data-user">
        <p>Имя: <?= Yii::$app->user->identity->username; ?></p>
        <p>Фамилия: <?= Yii::$app->user->identity->last_name; ?></p>
        <p>Телефон: <?= $model->phone; ?> <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: #00AF6F;" title="Подтверждён"></span>
            <span class="glyphicon glyphicon-remove" aria-hidden="true" title="Не Подтверждён" style="color: #FF1E00;"></span> </p>
        <a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit']) ?>" class="btn btn-default" style="margin-bottom: 10px">Редактировать профиль</a>
        <a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit-phone']) ?>" class="btn btn-default">Редактировать телефон</a>
    </div>
</div>
<hr><br>









<!-- Title -->
<div class="row">
    <div class="col-xs-12">
        <h4>Активные объявления | Завершённые объвления</h4>
    </div>
</div>

<div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-12">

        <div class="col-md-3 hero-feature">
            <div class="thumbnail">
                <img src="http://placehold.it/800x500" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 hero-feature">
            <div class="thumbnail">
                <img src="http://placehold.it/800x500" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 hero-feature">
            <div class="thumbnail">
                <img src="http://placehold.it/800x500" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 hero-feature">
            <div class="thumbnail">
                <img src="http://placehold.it/800x500" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 hero-feature">
            <div class="thumbnail">
                <img src="http://placehold.it/800x500" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 hero-feature">
            <div class="thumbnail">
                <img src="http://placehold.it/800x500" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 hero-feature">
            <div class="thumbnail">
                <img src="http://placehold.it/800x500" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 hero-feature">
            <div class="thumbnail">
                <img src="http://placehold.it/800x500" alt="">
                <div class="caption">
                    <h3>Feature Label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>


    </div>

</div>
















