<?php

namespace board\entities\ticket;

use board\entities\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $subject
 * @property string $content
 * @property int $status
 */
class Ticket extends ActiveRecord
{
    public static function create($user_id, $subject, $content)
    {
        $ticket = new static();
        $ticket->user_id = $user_id;
        $ticket->subject = $subject;
        $ticket->content = $content;
        $ticket->status = Status::OPEN;
        $ticket->created_at = time();
        return $ticket;
    }

    public static function ticketCreate($ticket_id, $user_id)
    {
        $ticket = new Status();
        $ticket->ticket_id = $ticket_id;
        $ticket->user_id = $user_id;
        $ticket->created_at = time();
        $ticket->status = Status::OPEN;
        $ticket->save();
    }

    public function edit($subject, $content)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->updated_at = time();
    }

    public function editStatus($status)
    {
        $this->status = $status;
        $this->updated_at = time();
    }

    public function canBeRemove()
    {
        return $this->isOpen();
    }

    public function isOpen()
    {
        return $this->status === Status::OPEN;
    }

    public function isClosed()
    {
        return $this->status === Status::CLOSED;
    }

    public function isApproved()
    {
        return $this->status === Status::APPROVED;
    }


    public function approved()
    {
        if ($this->isApproved()){
            throw new \DomainException('Заявка уже создана!');
        }
        $this->editStatus(Status::APPROVED);
    }

    public function close()
    {
        if ($this->isClosed()){
            throw new \DomainException('Заявка уже закрыта!');
        }
        $this->editStatus(Status::CLOSED);
    }

    public function reopen()
    {
        if ($this->isClosed()){
            throw new \DomainException('Заявка уже открыта!');
        }
        $this->editStatus(Status::APPROVED);
    }

    public function scopeForUser(User $user)
    {
        return Ticket::find()->where(['user_id' => $user->id])->all();
    }


    public function addMessage($user_id, $message)
    {
        if($this->isClosed()){
            throw new \DomainException('Заявка уже закрыта, сообщения отправлять нельзя!');
        }
        $this->sendMessage($user_id, $message);
    }


    //----------------------------------------------------------------
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
