<?php

namespace board\forms\dialog;

use yii\base\Model;

class DialogForm extends Model
{
    public $owner;
    public $user;

    public function rules()
    {
        return [
            [['owner', 'user'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner' => 'Owner',
            'user' => 'User',
        ];
    }
}