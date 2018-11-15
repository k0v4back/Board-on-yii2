<?php

namespace board\repositories;

use board\entities\Regions;
use DomainException;

class RegionsRepository
{
    public function get($id): Regions
    {
        return $this->getBy(['id' => $id]);
    }

    public function save(Regions $region)
    {
        if (!$region->save()) {
            throw new \RuntimeException('Ошибка при сохранении.');
        }
    }

    private function getBy(array $condition): Regions
    {
        if (!$region = Regions::find()->andWhere($condition)->limit(1)->one()) {
            throw new DomainException('Регион не найден.');
        }
        return $region;
    }
}