<?php

namespace board\forms\ticket;

use board\entities\User;
use yii\base\Model;

/**
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class StatusForm extends Model
{
    public $id;
    public $ticket_id;
    public $user_id;
    public $created_at;
    public $updated_at;
    public $status;

    public function rules()
    {
        return [
            [['ticket_id', 'user_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Ticket ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}