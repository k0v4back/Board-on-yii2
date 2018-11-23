<?php

namespace board\repositories;

use board\entities\Advert;
use board\entities\Regions;
use DomainException;

class AdvertRepository
{
    public function get($id): Advert
    {
        if(!$advert = Advert::findOne($id)){
            throw new DomainException('Обявление не найдено');
        }
        return $advert;
    }

    public function save(Advert $advert)
    {
        if (!$advert->save()) {
            throw new \RuntimeException('Ошибка сохранения объявления');
        }
    }

    public function remove(Advert $advert): void
    {
        if (!$advert->delete()) {
            throw new \RuntimeException('Ошибка удаления объявления.');
        }
    }

    public function getParentId($id)
    {
        static $new_mas = array();
        foreach (Regions::find()->where(['id' => $id])->all() as $key => $litle3){
            if($litle3->parent_id){
                $new_mas[] = $litle3->parent_id;
                $this->getParentId($litle3->parent_id);
            }
            return $new_mas;
        }
    }
}