<?php

namespace board\forms\ticket;

use yii\base\Model;

class TicketMessageForm extends Model
{
    public $user_id;
    public $ticket_id;
    public $content;

    public static function tableName()
    {
        return '{{%ticket_messages}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'ticket_id', 'content'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ticket_id' => 'Ticket ID',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}