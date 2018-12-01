<?php

namespace board\forms\dialog;

use yii\base\Model;
class DialogForm extends Model
{
    public $advert_id;
    public $owner_id;
    public $client_id;
    public $created_at;
    public $updated_at;
    public $user_new_messages;
    public $client_new_messages;

    public function rules()
    {
        return [
            [['advert_id', 'owner_id', 'client_id', 'created_at', 'updated_at', 'user_new_messages', 'client_new_messages'], 'integer'],
        ];
    }
}