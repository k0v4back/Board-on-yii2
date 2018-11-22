<?php

namespace board\repositories;

use board\entities\Advert;
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
}