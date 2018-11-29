<?php

namespace board\entities\ticket;

use board\entities\User;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class Status extends ActiveRecord
{
    public const OPEN = 1;
    public const APPROVED = 2;
    public const CLOSED = 3;

    public function statusList()
    {
        return [
            self::OPEN => 'Open',
            self::APPROVED => 'Approved',
            self::CLOSED => 'Closed',
        ];
    }

    public static function tableName()
    {
        return '{{%ticket_status}}';
    }

    public function isOpen()
    {
        return $this->status === self::OPEN;
    }

    public function isClosed()
    {
        return $this->status === self::CLOSED;
    }

    public function isApproved()
    {
        return $this->status === self::APPROVED;
    }

    //-------------------------------------------------------------------------
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}