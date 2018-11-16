<?php

namespace board\repositories;

use board\entities\Regions;
use DomainException;

class RegionsRepository
{
    public function get($id): Regions
    {
        if(!$region = Regions::findOne($id)){
            throw new DomainException('Регион не найден');
        }
        return $region;
    }

    public function save(Regions $region)
    {
        if (!$region->save()) {
            throw new \RuntimeException('Ошибка при сохранении.');
        }
    }
}