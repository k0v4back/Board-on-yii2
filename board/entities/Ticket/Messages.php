<?php

namespace board\entities\ticket;

use board\entities\User;
use Yii;
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
    public static function send($user_id, $message)
    {
        $ticket = new static();
        $ticket->user_id = $user_id;
        $ticket->content = $message;
        return $ticket;
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
