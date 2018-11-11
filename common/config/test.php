<?php
return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],
//        'request' => [
//            'class' => '\yii\web\Request',
//            'cookieValidationKey' => 'K5TG_r4lh-XFNqbuPckY-bGiwDEDCpJ9',
////            'class' => '\yii\web\Request',
////            'enableCookieValidation' => false,
////            'class' => '\yii\web\Request',
////            'enableCookieValidation' => false,
//        ],
        'request' => [
            'cookieValidationKey' => new \yii\helpers\UnsetArrayValue(),
        ],
    ],
];
