<?php

use dosamigos\fileupload\FileUpload;

?>

<h4>Загрузка фотографий</h4>
<div class="row" >
    <div class="col-xs-12">
        <?php if($picture) : ?>
            <?php for ($i = 0; $i < count($picture); $i++) : ?>
                <?= $i + 1?>)<img src="<?= $picture[$i] ?>" width="180" id="profile-picture" height="180" class="img-rounded" style="margin: 15px;">
                <img src="<?= $picture[$i] ?>" width="180" id="profile-picture2" height="180" class="img-rounded display-none">
            <?php endfor; ?>
        <?php endif; ?>
    </div>
</div>
<?= FileUpload::widget([
    'model' => $pictureUpload,
    'attribute' => 'image',
    'url' => ['advert/advert/picture', 'id' => $_GET['id']],
    'options' => ['accept' => 'image/*'],
    'clientOptions' => [
        'maxFileSize' => 100000000
    ],
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                      if (data.result.success) {
                          $("#profile-image-success").show();
                          $("#profile-picture").show();
                          $("#profile-image-fail").hide();
                          $("#profile-picture").attr("src", data.result.pictureUri);
                          $("#profile-picture2").show();
                        } else {
                          $("#profile-image-fail").html(data.result.errors.picture).show();
                          $("#profile-image-success").hide();
                        }
                        return false;
                      }',
    ],
]); ?><br><br>

<div class="alert alert-success display-none" id="profile-image-success">Фотография загружена. Чтобы её увидеть нажмите <b><a href="<?= \yii\helpers\Url::to(['/advert/advert/add-photo', 'id' => $_GET['id']]) ?>">сюда</a></b></div>
<div class="alert alert-danger display-none" id="profile-image-fail"> Возникла ошибка, фотография болжна быть определённого расширения и не больше 2 мегабайт </div>

<?php if($picture) : ?>
<div><h4>Вы загрузили <i><?= count($picture) ?></i> фотографии/ий</h4></div>
<?php endif; ?>

<a href="<?= \yii\helpers\Url::to(['cabinet/profile/index', 'id' => Yii::$app->user->identity->id]) ?>" class="btn btn-primary">Следующий шаг -></a>

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