<?php

use board\entities\Regions;

$this->title = $advert[0]['title'];


foreach ($breadcrumbs as $value){
    $region = Regions::find()->where(['id' => $value])->one();
    $this->params['breadcrumbs'][] = ['label' => $region->name,'url' => ['category', 'id' => $region->id]];
}

