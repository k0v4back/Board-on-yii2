<?php

namespace board\forms\dialog;

use yii\base\Model;

class MessagesForm extends Model
{
    public $dialog_id;
    public $message;
    public $user_id;

    public function rules()
    {
        return [
            [['dialog_id'], 'integer'],
            [['message'], 'string'],
            [['user_id'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dialog_id' => 'Dialog ID',
            'user_id' => 'User ID',
            'message' => 'Message',
        ];
    }
}