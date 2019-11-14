<?php
return [
    // set target language to be Russian


    // set source language to be English
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],


    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'wishlist' => [
            'class' => 'common\modules\wishlist\Module',
            'dbDateExpired' => 'CURDATE() + INTERVAL 7 DAY', //дата истечения срока действия избранного в БД
            'cokieDateExpired' => time() + 86400 * 365, //Время жизни куки с токеном
        ],
        'notifications' => [
            'class' => 'machour\yii2\notifications\NotificationsModule',
            // Point this to your own Notification class
            // See the "Declaring your notifications" section below
            'notificationClass' => 'common\components\Notification',
            // Allow to have notification with same (user_id, key, key_id)
            // Default to FALSE
            'allowDuplicate' => false,
            // Allow custom date formatting in database
            'dbDateFormat' => 'Y-m-d H:i:s',
            // This callable should return your logged in user Id
            'userId' => function () {
                return \Yii::$app->user->id;
            },
        ],
    ],
    'components' => [
        'wishlist' => [
            'class' => 'common\modules\wishlist\Wishlist'
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'GMT+3',
            'dateFormat' => 'd MMMM yyyy',
            'datetimeFormat' => 'd-M-Y H:i:s',
            'timeFormat' => 'H:i:s',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'ru',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'ru',
                ],
            ],
        ],
        'authManager' => [
                'class' => 'yii\rbac\DbManager',
            ],
        ],
];
