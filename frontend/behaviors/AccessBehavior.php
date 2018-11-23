<?php

namespace frontend\behaviors;

use yii\base\Behavior;
use Yii;
use yii\web\Controller;

class AccessBehavior extends Behavior
{
    public $owner;

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'checkAccess'
        ];
    }

    public function checkAccess()
    {
        if(Yii::$app->user->isGuest)
        {
            return Yii::$app->controller->redirect(['user/login/login']);
        }
    }

    public function test()
    {
        var_dump($this->owner);
    }
}