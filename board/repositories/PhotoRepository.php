<?php

namespace board\repositories;

use board\entities\Photo;
use DomainException;

class PhotoRepository
{
    public function get($id): Photo
    {
        if(!$photo = Photo::findOne($id)){
            throw new DomainException('Обявление не найдено');
        }
        return $photo;
    }

    public function save(Photo $photo)
    {
        if (!$photo->save()) {
            throw new \RuntimeException('Ошибка сохранения объявления');
        }
    }

    public function remove(Photo $photo): void
    {
        if (!$photo->delete()) {
            throw new \RuntimeException('Ошибка удаления объявления.');
        }
    }
}