<?php

use yii\authclient\clients\Facebook;
use yii\authclient\clients\GitHub;
use yii\authclient\clients\Google;
use yii\authclient\clients\LinkedIn;
use yii\authclient\clients\TwitterOAuth2;
use yii\authclient\Collection;
use yii\helpers\ArrayHelper;
use yii\i18n\PhpMessageSource;
use yii\mutex\MysqlMutex;
use yii\queue\Queue;
use yii\swiftmailer\Mailer;
use yii\web\DbSession;
use yii\web\UrlManager;
use yii\web\UrlNormalizer;

return [
    'name' => 'Modelo de Projeto Yii2',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'sourceLanguage' => 'pt-br',
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerBackend' => [
            'class' => UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => require(__DIR__ . '/../../backend/config/routes.php'),
        ],
    ],


];
