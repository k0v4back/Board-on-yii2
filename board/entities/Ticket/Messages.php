<?php

namespace board\entities\ticket;

use board\entities\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ticket_messages".
 *
 * @property int $id
 * @property int $user_id
 * @property int $ticket_id
 * @property int $content
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property Ticket $ticket
 */
class Messages extends ActiveRecord
{
    public static function send($ticket_id, $user_id, $message)
    {
        $ticket = new static();
        $ticket->ticket_id = $ticket_id;
        $ticket->user_id = $user_id;
        $ticket->content = $message;
        $ticket->created_at = time();
        return $ticket;
    }

    public static function tableName()
    {
        return '{{%ticket_messages}}';
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTicket()
    {
        return $this->hasOne(Ticket::class, ['id' => 'ticket_id']);
    }
}
