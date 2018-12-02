<?php
namespace board\forms\users;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;

    public function __construct($role, $config = [])
    {
        $this->role = $role;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\board\entities\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\board\entities\User', 'message' => 'This email address has already been taken.'],

            ['role', 'required'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
}
