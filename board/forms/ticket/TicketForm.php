<?php

namespace board\forms\ticket;

use yii\base\Model;

class TicketForm extends Model
{
    public static function tableName()
    {
        return '{{%ticket}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['created_at', 'updated_at', 'subject', 'content', 'status'], 'required'],
            [['created_at', 'updated_at', 'subject', 'content'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'subject' => 'Subject',
            'content' => 'Content',
            'status' => 'Status',
        ];
    }
}