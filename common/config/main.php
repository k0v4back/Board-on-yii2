<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => [
        'common\bootstrap\SetUp',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\MemCache',
//            'useMemcached' => true,
//        ],

        'authManager' => [
            'class' => 'console\manager\AuthManager',
            'itemFile' => '@common/rbac/items.php',
            'assignmentFile' => '@common/rbac/assignments.php',
            'ruleFile' => '@common/rbac/rules.php',
        ],
    ],
];
