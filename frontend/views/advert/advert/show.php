<?php

use board\entities\Regions;

$this->title = $advert[0]['title'];


foreach ($breadcrumbs as $value){
    $region = Regions::find()->where(['id' => $value])->one();
    $this->params['breadcrumbs'][] = ['label' => $region->name,'url' => ['category', 'id' => $region->id]];
}

//var_dump($photo);die();
//var_dump($photo[0]['name']);die();
//var_dump($region->name);
//var_dump($city->name);
//die();
?>

<a href="#" class="btn btn-primary">Редактировать</a>
<a href="#" class="btn btn-primary">Фотографии</a>
<a href="#" class="btn btn-success">Опубликовать</a>
<a href="#" class="btn btn-danger">Удалить</a>
<br>
<br>



<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="#" title="Добавить в избранное">
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
                        <li data-target="#dws-slider" data-slide-to="0" class="active"></li>
                        <li data-target="#dws-slider" data-slide-to="1"></li>
                        <li data-target="#dws-slider" data-slide-to="2"></li>
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
        // var city = 'Калининград Дзержинского 44';
        var city = '<?= $point ?>';
        var geocoder = new ymaps.geocode(
            // Строка с адресом, который нужно геокодировать
            city,
            // 'Калининград Дзер    жинского 44',
            // требуемое количество результатов
            { results: 1 }
        );
        // После того, как поиск вернул результат, вызывается callback-функция
        geocoder.then(
            function (res) {
                // координаты объекта
                var coord = res.geoObjects.get(0).geometry.getCoordinates();
                var map = new ymaps.Map('map', {
                    // Центр карты - координаты первого элемента
                    center: coord,
                    // Коэффициент масштабирования
                    zoom: 7,
                    // включаем масштабирование карты колесом
                    behaviors: ['default', 'scrollZoom'],
                    controls: ['mapTools']
                });
                // Добавление метки на карту
                map.geoObjects.add(res.geoObjects.get(0));
                // устанавливаем максимально возможный коэффициент масштабирования - 1
                map.zoomRange.get(coord).then(function(range){
                    map.setCenter(coord, range[1] - 1)
                });
                // Добавление стандартного набора кнопок
                map.controls.add('mapTools')
                // Добавление кнопки изменения масштаба
                    .add('zoomControl')
                    // Добавление списка типов карты
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

























