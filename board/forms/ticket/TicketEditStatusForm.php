<?php

namespace board\forms\ticket;

use yii\base\Model;

class TicketEditStatusForm extends Model
{
    public $id;
    public $status;

    public static function tableName()
    {
        return '{{%ticket}}';
    }

    public function rules()
    {
        return [
            [['status'], 'required'],
        ];
    }
}