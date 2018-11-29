<?php

namespace board\forms\ticket;

use yii\base\Model;

class TicketForm extends Model
{
    public $user_id;
    public $content;
    public $subject;

    public static function tableName()
    {
        return '{{%ticket}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['content', 'subject'], 'string'],
        ];
    }
}