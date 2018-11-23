<?php

use board\entities\Regions;

$this->title = $advert[0]['title'];
$this->params['breadcrumbs'][] = $this->title;

?>


<?php


function getParentId($id)
{
    foreach (Regions::find()->where(['id' => $id])->all() as $litle3){
        if($litle3->parent_id){
            $mas[] = $litle3->parent_id;
            echo $litle3->parent_id . '/';
            getParentId($litle3->parent_id);
        }
    }
}

getParentId($advert[0]['region_id']);
