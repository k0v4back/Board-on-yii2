<?php
namespace board\forms\users;

use yii\base\Model;

class RbacForm extends Model
{
    public $username;
    public $role;

    public function rules()
    {
        return [
            [['username'], 'required'],
            ['role', 'string', 'max' => 64],
        ];
    }
}
