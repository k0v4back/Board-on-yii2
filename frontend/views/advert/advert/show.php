<?php

use board\entities\Regions;

$this->title = $advert[0]['title'];


foreach ($breadcrumbs as $value){
    $region = Regions::find()->where(['id' => $value])->one();
    $this->params['breadcrumbs'][] = ['label' => $region->name,'url' => ['category', 'id' => $region->id]];
}

?>

<a href="#" class="btn btn-primary">Редактировать</a>
<a href="#" class="btn btn-primary">Фотографии</a>
<a href="#" class="btn btn-success">Опубликовать</a>
<a href="#" class="btn btn-danger">Удалить</a>




<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="#" title="Добавить в избранное">
                    <i class="far fa-star fa-lg" style="float:right; margin:20px; size: 20px"></i>
                </a>
                <h3>Название объявления</h3>
                <h4>Цена</h4>
                <div class="col-lg-12">
            <div id="dws-slider" class="carousel slide" data-ride="carousel">
                <!-- Обертка для слайдов -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="http://placehold.it/800x460" alt="Картинка 1">
                    </div>
                    <div class="item"><img src="http://placehold.it/800x460" alt="Картинка 1">
                        <div class="carousel-caption">
                            <h3 class="text-uppercase">Анимированная прокрутка</h3>
                            <p>Aenean cursus imperdiet erat sit amet facilisis. Phasellus congue, sem in consectetur accumsan,
                                tellus risus sollicitudin mauris, quis ornare libero magna eget ex.</p>
                        </div>
                    </div>
                    <div class="item"><img src="http://placehold.it/800x460" alt="Картинка 1">
                        <div class="carousel-caption">
                            <h3 class="text-uppercase">Простая установка</h3>
                            <p>Praesent dictum, orci eget eleifend auctor, urna ex dapibus odio, vitae pretium neque massa vel
                                neque. Donec et interdum diam. Morbi dignissim vestibulum mi ac viverra.</p>
                        </div>
                    </div>
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
        </div>

            <div style="text-align: center">
            <p style="font-size: 15px;">
                Равным образом дальнейшее развитие различных форм деятельности представляет собой интересный эксперимент проверки модели развития. Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий представляет собой интересный эксперимент проверки дальнейших направлений развития. С другой стороны начало повседневной работы по формированию позиции в значительной степени обуславливает создание системы обучения кадров, соответствует насущным потребностям. Таким образом сложившаяся структура организации представляет собой интересный эксперимент проверки направлений прогрессивного развития. Таким образом новая модель организационной деятельности позволяет оценить значение соответствующий условий активизации.
            </p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="col-lg-8">
            <p>Имя</p>
            <p>На сервисе с каккой-то даты</p>
            <a href="#" class="btn btn-default">100500 объявлений</a>
        </div>
        <div class="col-lg-4">
                <img src="http://placehold.it/800x460" alt="..." class="img-circle top-cover center-block" style="width: 80px; height: 80px">
        </div>

    </div>
</div>




<div id="map" style="width: 550px; height: 400px"></div>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>

<script type='text/javascript'>
    ymaps.ready(init);
    function init(){
        var geocoder = new ymaps.geocode(
            // Строка с адресом, который нужно геокодировать
            'Калининград Дзержинского 44',
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

























