<?php

namespace common\bootstrap;

use board\services\users\PasswordResetRequestService;
use board\services\users\SmsRuService;
use yii\base\BootstrapInterface;
use Yii;
use yii\di\Instance;
use yii\mail\MailerInterface;
use board\services\contact\ContactService;

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

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });


        //Для несложных операция когда
        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail'],
            Instance::of(MailerInterface::class)
        ]);

//        $container->setSingleton(SmsRuService::class, [], [
//            $app->params['appId'],
//        ]);

//        $container->setSingleton(SmsRuService::class, function () use ($app) {
//            return new SmsRuService($app->params['appId']);
//        });

    }
}