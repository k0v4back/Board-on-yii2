<?php

namespace board\entities\dialog;

use yii\db\ActiveRecord;
/**
 * This is the model class for table "dialog".
 *
 * @property int $id
 * @property int $advert_id
 * @property int $owner_id
 * @property int $client_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_new_messages
 * @property int $client_new_messages
 */
class Dialog extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%dialog}}';
    }

    public function writeMessage($userId, $message)
    {
        if($userId !== $this->owner_id && $userId !== $this->client_id){
            throw new \DomainException('Такой диалог не найден');
        }

//        $createMessage = Messages::find()->where(['user_id' => $userId])->all();
        $createMessage = new Messages();
        $message->dialog_id = $this->id;
        $message->user_id = $userId;
        $message->message = $message;

        if($userId === $this->owner_id){
            $this->user_new_messages++;
        }

        if($userId === $this->client_id){
            $this->client_new_messages++;
        }

        $createMessage->save(false);
    }

    public function readByOwner()
    {
        $this->user_new_messages = 0;
        $this->save(false);
    }

    public function readByClient()
    {
        $this->client_new_messages = 0;
        $this->save(false);
    }
}
