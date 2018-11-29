<?php

namespace board\forms\ticket;

use yii\base\Model;

class TicketEditForm extends Model
{
    public $id;
    public $subject;
    public $content;

    public static function tableName()
    {
        return '{{%ticket}}';
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['subject', 'content'], 'required'],
        ];
    }
}