<?php

namespace board\forms\profile;

use board\entities\User;
use yii\base\Model;

class EditPhoneForm extends Model
{
    public $phone;

    public function __construct(User $user, array $config = [])
    {
        $this->phone = $user->phone;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['phone'], 'integer'],
        ];
    }
}