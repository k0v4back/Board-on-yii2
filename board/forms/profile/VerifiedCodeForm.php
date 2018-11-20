<?php

namespace board\forms\profile;

use yii\base\Model;

class VerifiedCodeForm extends Model
{
    public $code;
//
    public function __construct($code, array $config = [])
    {
        $this->code = $code;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['code'], 'required'],
        ];
    }
}