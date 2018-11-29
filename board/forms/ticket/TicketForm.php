<?php

namespace board\forms\ticket;

use yii\base\Model;

class TicketForm extends Model
{
    public $user_id;
    public $subject;
    public $content;
    public $status;

    public static function tableName()
    {
        return '{{%ticket}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['subject', 'content', 'status'], 'required'],
            [['subject', 'content'], 'string', 'max' => 255],
        ];
    }
}