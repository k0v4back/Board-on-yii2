<?php

use dosamigos\fileupload\FileUpload;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-lg-2 col-md-6 col-sm-6">
        <img src="<?= $picture; ?>" alt="140x140" width="180" id="profile-picture" height="180"
             class="img-rounded"> <?php if ($currentUser) { ?>
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
    <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="<?= Url::to(['advert/advert/create']) ?>" class="btn btn-primary">Создать объявление</a>
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
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More
                            Info</a>
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
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More
                            Info</a>
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
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More
                            Info</a>
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
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More
                            Info</a>
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
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More
                            Info</a>
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
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More
                            Info</a>
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
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More
                            Info</a>
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
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More
                            Info</a>
                    </p>
                </div>
            </div>
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

</style>

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
















