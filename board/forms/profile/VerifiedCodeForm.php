<?php

namespace board\forms\profile;

use yii\base\Model;

class VerifiedCodeForm extends Model
{
    public function rules()
    {
        return [
            [['code'], 'required'],
        ];
    }
}