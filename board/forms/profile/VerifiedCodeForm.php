<?php

namespace board\forms\profile;

use yii\base\Model;

class VerifiedCodeForm extends Model
{
    public $code;

    public function rules()
    {
        return [
            [['code'], 'required'],
        ];
    }
}