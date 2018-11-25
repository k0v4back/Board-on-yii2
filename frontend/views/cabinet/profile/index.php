<?php

use dosamigos\fileupload\FileUpload;
use yii\helpers\Url;


//var_dump($advertClosed);die();
?>

<div class="row">
    <div class="col-lg-2 col-md-6 col-sm-6">
        <img src="<?= $picture; ?>" width="180" id="profile-picture" height="180" class="img-rounded"> <?php if ($currentUser) { ?>
            <?= FileUpload::widget([
                'model' => $pictureUpload,
                'attribute' => 'image',
                'url' => ['cabinet/profile/picture'], // your url, this is just for demo purposes,
                'options' => ['accept' => 'image/*'],
                'clientOptions' => [
                    'maxFileSize' => 100000000
                ],
                // Also, you can specify jQuery-File-Upload events
                // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
                'clientEvents' => [
                    'fileuploaddone' => 'function(e, data) {
                      if (data.result.success) {
                          $("#profile-image-success").show();
                          $("#profile-image-fail").hide();
                          $("#profile-picture").attr("src", data.result.pictureUri);
                        } else {
                          $("#profile-image-fail").html(data.result.errors.picture).show();
                          $("#profile-image-success").hide();
                        }
                      }',
                ],
            ]); ?>
        <?php } ?>
        <div class="alert alert-success display-none" id="profile-image-success">Фотография загружена.</div>
        <div class="alert alert-danger display-none" id="profile-image-fail"> Возникла ошибка, фотография болжна быть определённого расширения и не больше 5 мегабайт </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 data-user">
        <p>Имя: <?= $model->username; ?></p>
        <p>Фамилия: <?= $model->last_name; ?></p>
        <?php
        if ($currentUser) {
            ?>
            <p>Телефон: <?= $model->phone; ?>
            <?php
            status($currentUser, $user, $model);
            ?>
            <?php if ($model->phone_verified == 1) : ?>
                <span class="glyphicon glyphicon-ok" aria-hidden="true" title="Подтверждён"
                      style="color: #06A006;"></span> </p>
            <?php else : ?>
                <span class="glyphicon glyphicon-remove" aria-hidden="true" title="Не подтверждён"
                      style="color: #FF1E00;"></span> </p>
            <?php endif; ?>
            <a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit', 'id' => $model->id]) ?>" class="btn btn-default"
               style="margin-bottom: 10px">Редактировать профиль</a>
            <a href="<?= \yii\helpers\Url::to(['cabinet/profile/edit-phone', 'id' => $model->id]) ?>"
               class="btn btn-default">Редактировать телефон</a>
            <?php
        }
        ?>
    </div>
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->getId() == $model->id) : ?>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <?php if($lastId) : ?>
            <a href="<?= Url::to(['advert/advert/create', 'id' => $lastId->id + 1]) ?>" class="btn btn-primary">Создать объявление</a>
        <?php endif; ?>
        <?php if(!$lastId) : ?>
            <a href="<?= Url::to(['advert/advert/create', 'id' => 1]) ?>" class="btn btn-primary">Создать объявление</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<hr><br>


<!-- Title -->
<div class="row">
    <div class="col-xs-12">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <button class="btn btn-default btn1">Активные объявления</button> | <button class="btn btn-default btn2">Не активные</button>
        <br>
        <br>
    </div>
</div>

<div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-12">

        <div class="block_with_text1">
            <h4>Активные объявления</h4>
            <?php foreach ($adverts as $key => $advert) : ?>
                <div class="col-md-3 hero-feature">
                    <div class="thumbnail">
                        <?php
                            $photo = \board\entities\Photo::find()->where(['advert_id' => $advert->id])->one();
                        ?>
                        <a href="<?= Url::to(['advert/advert/show', 'id' => $advert->id]) ?>"><img src="<?= Yii::$app->params['storageUri'] . $photo->name ?>"></a>
                        <div class="caption">
                            <h3><a href="<?= Url::to(['advert/advert/show', 'id' => $advert->id]) ?>"><?= $advert->title ?></a></h3>
                            <h4><?= $advert->price ?> ₽</h4>
                            <p><?= $date = Yii::$app->formatter->asDatetime($advert->created_at, 'dd-m-Y');?></p>
                            <a href="<?= Url::to(['advert/advert/show', 'id' => $advert->id]) ?>" class="btn btn-default">Смотреть подробнее</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="block_with_text2">
        <h4>Не активные объявления</h4>
        <?php foreach ($advertClosed as $key => $advert) : ?>
            <div class="col-md-3 hero-feature">
                <div class="thumbnail">
                    <?php
                        $photo = \board\entities\Photo::find()->where(['advert_id' => $advert->id])->one();
                    ?>
                    <a href="<?= Url::to(['advert/advert/show', 'id' => $advert->id]) ?>"><img src="<?= Yii::$app->params['storageUri'] . $photo->name ?>"></a>
                    <div class="caption">
                        <h3><a href="<?= Url::to(['advert/advert/show', 'id' => $advert->id]) ?>"><?= $advert->title ?></a></h3>
                        <h4><?= $advert->price ?> ₽</h4>
                        <p><?= $date = Yii::$app->formatter->asDatetime($advert->created_at, 'dd-m-Y');?></p>
                        <a href="<?= Url::to(['advert/advert/show', 'id' => $advert->id]) ?>" class="btn btn-default">Смотреть подробнее</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>


    </div>

</div>

<style>
    .load {
        margin: 20px;
    }

    .data-user {
        margin-top: 10px;
    }

    .display-none {
        display: none;
    }

    .block_with_text2{
        display: none;
    }



</style>
<script>
    $('.btn1').click(function(){
        $(".block_with_text1").fadeToggle(100);
        $('.block_with_text2').hide();
    });
    $('.btn2').click(function(){
        $(".block_with_text2").fadeToggle(100);
        $('.block_with_text1').hide();
    });
</script>

<?php


function status($currentUser, $user, $model)
{

    if ($currentUser) {

        if ($user->isPhoneVerified() && $model->phone_verified_token_expire == null && $model->phone && $model->phone_verified != 1) {
            ?>
            <a href="<?= \yii\helpers\Url::to(['cabinet/profile/code', 'id' => $model->id]) ?>" class="btn btn-danger">Подтвердить
                телефон</a>
            <?php
        } elseif ($user->isPhoneVerified() && $model->phone_verified_token_expire == null && $model->phone) {
            ?>
            <h4>Телефон: <i><?= $model->phone ?></i> успешно подтверждён!</h4>
            <?php
        }

        if (time() > $model->phone_verified_token_expire && $model->phone_verified_token_expire != null && $model->phone_verified == 0 && $model->phone) {
            ?>
            <a href="<?= \yii\helpers\Url::to(['cabinet/profile/code', 'id' => $model->id]) ?>" class="btn btn-danger">Подтвердить
                телефон</a>
            <?php
        } elseif (time() < $model->phone_verified_token_expire && $model->phone_verified == 0) {
            $expire = $model->phone_verified_token_expire - time();
            echo " Вам нужно подождать " . $expire . " cекунды для того чтобы повторить попытку подтверждыения телефона";
        } elseif ($model->phone_verified_token == 1) {
            ?>
            <h4>Телефон: <i><?= $model->phone ?></i> успешно подтверждён!</h4>
            <?php
        }

    }
}

?>