<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 */

use craft\helpers\App;

return [
    'id' => App::env('APP_ID') ?: 'CraftCMS',
    'modules' => [
        'my-module' => \modules\Module::class,
    ],
    'components' => [
        'redis' => [
            'class' => yii\redis\Connection::class,
            'hostname' => App::env('REDIS_HOST') ?: 'localhost',
            'port' => App::env('REDIS_PORT') ?: 6379,
            'password' => App::env('REDIS_PASSWORD'),
        ],
        'cache' => [
            'class' => yii\redis\Cache::class,
            'defaultDuration' => 86400,
            'keyPrefix' => App::env('APP_ID') ?: 'craft_',
        ],
        'session' => function() {
            $config = App::sessionConfig();
            $config['class'] = yii\redis\Session::class;
            return Craft::createObject($config);
        },
    ],
    //'bootstrap' => ['my-module'],
];
