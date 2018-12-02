<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'RU-ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'common\bootstrap\SetUp',
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'storage' => [
            'class' => 'frontend\components\Storage',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => $params['cookieValidationKey'],
        ],
        'user' => [
            'identityClass' => 'board\entities\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => $params['cookieDomain']],
            'loginUrl' => ['user/login/login/'],
        ],
        'session' => [
            'name' => '_session',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'about' => 'site/about',
                '<_a:login|logout>' => 'site/<_a>',

//                'cabinet/profile/index/<id:\d+>' => 'profile',
                'profile/<id:\d+>' => 'cabinet/profile/index',
                'profile/edit/<id:\d+>' => 'cabinet/profile/edit',
                'profile/editPhone/<id:\d+>' => 'cabinet/profile/edit-phone',

                'create/<id:\d+>' => 'advert/advert/create',
                'show/<id:\d+>' => 'advert/advert/show',
                'photo/<id:\d+>' => 'advert/advert/add-photo',

                'dialog/<id:\d+>' => 'dialog/dialog/dialog',

            ],
        ],
    ],
    'params' => $params,
];
