<?php

namespace board\forms\profile;

use yii\base\Model;

class UploadAvatarForm extends Model
{
//    public $advert_id;
//    public function __construct($advert_id, $config = [])
//    {
//        $this->advert_id = $advert_id;
//        parent::__construct($config);
//    }

    public $image;

    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }
}