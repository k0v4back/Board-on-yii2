<?php

namespace board\forms\users;

use board\entities\User;
use yii\base\Model;

class EditNameForm extends Model
{
    public $id;
    public $username;
    public $last_name;

    public function __construct(User $user, array $config = [])
    {
        $this->id = $user->id;
        $this->username = $user->username;
        $this->last_name = $user->last_name;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['username', 'last_name'], 'required'],
            [['username', 'last_name'], 'string'],
        ];
    }
}