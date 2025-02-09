<?php

use kartik\grid\Module as GridModule;
use kartik\datecontrol\Module as DateControlModule;
use kartik\widgets\DatePicker;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'language' => 'pt-BR',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => GridModule::class,
        ],
        'datecontrol' => [
            'class' => DateControlModule::class,
            'displaySettings' => [
                DateControlModule::FORMAT_DATE => 'dd/MM/yyyy',
                DateControlModule::FORMAT_TIME => 'HH:mm',
                DateControlModule::FORMAT_DATETIME => 'dd/MM/yyyy HH:mm',
            ],
            'saveSettings' => [
                DateControlModule::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                DateControlModule::FORMAT_TIME => 'php:H:i:s',
                DateControlModule::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            'displayTimezone' => 'America/Recife',
            'saveTimezone' => 'UTC',
            'autoWidget' => true,
            'ajaxConversion' => true,
            'autoWidgetSettings' => [
                DateControlModule::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], // example
                DateControlModule::FORMAT_DATETIME => [], // setup if needed
                DateControlModule::FORMAT_TIME => [], // setup if needed
            ],
            'widgetSettings' => [
                DateControlModule::FORMAT_DATE => [
                    'class' => DatePicker::class,
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class' => 'form-control'],
                    ]
                ]
            ],
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            'rules' => require(__DIR__ . '/routes.php'),
        ],
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['login', 'error'],
            ],
            [
                'allow' => true,
                'actions' => ['register', 'error'],
            ],
            [
                'allow' => true,
                'controllers' => ['gii/*'],
            ],
            [
                'allow' => true,
                'controllers' => ['debug/*'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function ($rule, $action) {
            Yii::$app->response->redirect(['/login']);
        },
    ],
    'params' => $params,
];
