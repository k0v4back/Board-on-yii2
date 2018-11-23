<?php

namespace board\entities;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property int $advert_id
 * @property string $name
 * @property int $created_at
 *
 * @property Advert $advert
 */
class Photo extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%photo}}';
    }

    public function getAdvert()
    {
        return $this->hasOne(Advert::class, ['id' => 'advert_id']);
    }

    public static function upload($advert_id, $name)
    {
        $photo = new static;
        $photo->advert_id = $advert_id;
        $photo->created_at = time();
        $photo->name = $name;
        return $photo;
    }
}
