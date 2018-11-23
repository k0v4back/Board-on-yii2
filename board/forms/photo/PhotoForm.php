<?php

namespace board\forms\photo;

use board\entities\Advert;
use yii\base\Model;

class PhotoForm extends Model
{
    public $advert_id;
    public $name;
    public $created_at;

    public function rules()
    {
        return [
            [['advert_id', 'created_at'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['advert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Advert::class, 'targetAttribute' => ['advert_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'advert_id' => 'Advert ID',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }
}