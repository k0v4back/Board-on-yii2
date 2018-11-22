<?php

namespace board\forms\profile;

use yii\base\Model;

class UploadAvatarForm extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }
}