<?php

use board\entities\Regions;

$this->title = $advert[0]['title'];


foreach ($breadcrumbs as $value){
    $region = Regions::find()->where(['id' => $value])->one();
    $this->params['breadcrumbs'][] = ['label' => $region->name,'url' => ['category', 'id' => $region->id]];
}

//var_dump($advertSimilar);die();
?>

<?php
$status = $advert[0]['status'];
if($status != 2 && Yii::$app->user->getId() != $user->id)
{
    Yii::$app->response->redirect('\site\index');
}

if(Yii::$app->user->getId() == $user->id){
    switch ($status) {
        case 0:
            ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Ваше объявление теперь в черновике, если вы хотите его опубликовать, то нажмите на кнопку <strong>Опубликовать</strong> (только вы видети это сообщение).
            </div>
            <?php
            break;
        case 1:
            ?>
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Ваше объявление проходит модерацию, <strong>скоро его проверят</strong> (только вы видети это сообщение).
            </div>
            <?php
            break;
        case 2:
            ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Ваше объявление <strong>активно</strong> (только вы видети это сообщение).
            </div>
            <?php
            break;
        case 3:
            ?>
            <div class="alert alert-warning alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Ваше объявление закрыто (только вы видети это сообщение).
            </div>
            <?php
            break;
    }
}
?>


<?php if(Yii::$app->user->getId() == $user->id) : ?>
<a href="<?= \yii\helpers\Url::to(['advert/advert/edit', 'id' => $advert[0]['id']]) ?>" class="btn btn-primary">Редактировать</a>
<a href="<?= \yii\helpers\Url::to(['advert/advert/add-photo', 'id' => $advert[0]['id']]) ?>" class="btn btn-primary">Фотографии</a>
<a href="<?= \yii\helpers\Url::to(['advert/advert/public', 'id' => $advert[0]['id']]) ?>" class="btn btn-success">Опубликовать</a>
<a href="<?= \yii\helpers\Url::to(['advert/advert/close', 'id' => $advert[0]['id']]) ?>" class="btn btn-warning">Закрыть</a>
<a href="<?= \yii\helpers\Url::to(['advert/advert/delete-advert', 'id' => $advert[0]['id']]) ?>" class="btn btn-danger">Удалить</a>
<br>
<br>
<?php endif; ?>



<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="<?= \yii\helpers\Url::to(['advert/advert/add', 'id' => $advert[0]['id']]) ?>" title="Добавить в избранное">
                    <i class="far fa-star fa-lg" style="float:right; margin:20px; size: 20px"></i>
                </a>
                <h3><?= $advert[0]['title'] ?></h3>
                <h4><?= $advert[0]['price'] ?> ₽</h4>
                <div id="dws-slider" class="carousel slide" data-ride="carousel">
                    <!-- Обертка для слайдов -->
                    <div class="carousel-inner" role="listbox" style="height: 450px">

                        <?php foreach ($photos as $key => $photo) : ?>
                            <?php if($key == 0) : ?>
                                <div class="item active"><img src="<?= Yii::$app->params['storageUri'] . $photo->name ?>">
                            <?php endif; ?>
                                    <?php if($key != 0) : ?>
                                    <div class="item"><img src="<?= Yii::$app->params['storageUri'] . $photo->name ?>">
                                        <?php endif; ?>

                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Элементы управления -->
                    <a class="left carousel-control" href="#dws-slider" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#dws-slider" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <ol class="carousel-indicators">
                        <?php if($photos) : ?>
                        <li data-target="#dws-slider" data-slide-to="0" class="active"></li>
                            <?php if(count($photos) > 1) : ?>
                                <?php for($i = 1; $i < count($photos); $i++) : ?>
                                <li data-target="#dws-slider" data-slide-to="<?= $i ?>"></li>
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ol>
                </div>
            </div>

            <div style="margin-left: 8px">
            <p style="font-size: 15px;">
                <?= $advert[0]['content'] ?>
            </p>
            </div>
        </div>
    </div>
    <div class="col-lg-4" style="border: 1px solid #DDDDDD; padding: 10px; border-radius: 5px; font-size: 15px">
        <div class="col-lg-8">
            <p><a href="<?= \yii\helpers\Url::to(['cabinet/profile/index', 'id' => $user->id]) ?>"><?= $user->username ?></a></p>
            <p><?= $user->phone ?></p>
            <p>На сервисе с  <?= Yii::$app->formatter->asDatetime($user->created_at, 'dd-mm-Y');?></p>
            <a href="<?= \yii\helpers\Url::to(['cabinet/profile/index', 'id' => $user->id]) ?>" class="btn btn-default"><?= count($advertCont); ?> объявлений открыто</a>
        </div>
        <div class="col-lg-4">
                <img src="<?= Yii::$app->params['storageUri'] . $avatar->name ?>" alt="..." class="img-circle top-cover center-block" style="width: 80px; height: 80px">
        </div>
    </div>
</div>
<br>
<br>



<div id="map" style="width: 550px; height: 400px"></div>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>

<?php $point = $region->name . ', ' . $city->name . ', ' . $advert[0]['address'] ?>
<script type='text/javascript'>
    ymaps.ready(init);
    function init(){
        var city = '<?= $point ?>';
        var geocoder = new ymaps.geocode(
            city,
            { results: 1 }
        );
        geocoder.then(
            function (res) {
                var coord = res.geoObjects.get(0).geometry.getCoordinates();
                var map = new ymaps.Map('map', {
                    center: coord,
                    zoom: 7,
                    behaviors: ['default', 'scrollZoom'],
                    controls: ['mapTools']
                });
                map.geoObjects.add(res.geoObjects.get(0));
                map.zoomRange.get(coord).then(function(range){
                    map.setCenter(coord, range[1] - 1)
                });
                map.controls.add('mapTools')
                    .add('zoomControl')
                    .add('typeSelector');
            }
        );
    }
</script>
<script>
    $('.carousel').carousel({
        interval: false
    })
</script>

    <br>
    <a href="<?= \yii\helpers\Url::to(['dialog/dialog/create', 'advert' => $advert[0]['id'], 'owner' => $user->id]) ?>" class="btn btn-success"><i class="fas fa-envelope"></i> Написать сообщение</a>
    <a href="#" class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal"><i class="fas fa-phone"></i> Позвонить</a>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Номер владельца объявления</h4>
                </div>
                <div class="modal-body">
                    <h3>Номер телефона: <?= $user->phone ?></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <br>
<br>


    <?php if(count($advertSimilar) >= 1):  ?>
    <h3>Похожии объявления</h3>
    <?php endif; ?>
    <?php if(count($advertSimilar) < 1):  ?>
        <h3>Похожих объявлений не найдено</h3>
    <?php endif; ?>


    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-9">

            <?php if(count($advertSimilar) >= 1):  ?>
            <?php foreach ($advertSimilar as $key => $popular) : ?>
            <div class="col-md-4 hero-feature">
                <div class="thumbnail">
                    <?php
                        $photo = \board\entities\Photo::find()->where(['advert_id' => $popular->id])->one();
                    ?>
                    <a href="<?= \yii\helpers\Url::to(['advert/advert/show', 'id' => $popular->id]) ?>"><img src="<?= Yii::$app->params['storageUri'] . $photo->name ?>"></a>
                    <div class="caption">
                        <a href="<?= \yii\helpers\Url::to(['advert/advert/show', 'id' => $popular->id]) ?>"><h3><?= $popular->title ?></h3></a>
                        <p><?= substr($popular->content, 0, 50).'...'  ?></p>
                        <p>
                            <a href="<?= \yii\helpers\Url::to(['advert/advert/show', 'id' => $popular->id]) ?>" class="btn btn-default">Смотреть подробнее</a>

                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach;  ?>
            <?php endif; ?>


        </div>

    </div>


