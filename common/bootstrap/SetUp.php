<?php

namespace common\bootstrap;

use frontend\services\users\PasswordResetRequestService;
use yii\base\BootstrapInterface;
use Yii;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;

        //container->setSingleton(PasswordResetRequestService::class, function () use ($app){
        //return new PasswordResetRequestService([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot']);
        //});

        //Можно не писать, так как сам yii создаст экземляр через new потому что у него нету конструктора 
        $container->setSingleton(PasswordResetRequestService::class);

        //Для несложных операция когда
        $container->setSingleton(PasswordResetRequestService::class, [], [
            $app->params['adminEmail']
        ]);

    }
}