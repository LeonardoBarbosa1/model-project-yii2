<?php
$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mysql.model-project.localhost;dbname=model-project',
//            'dsn' => 'mysql:host=127.0.0.1;dbname=model-project',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];


$config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    'allowedIPs' => ['127.0.0.1', '::1'],
    'generators' => [
        'model' => [
            'class' => 'antonyz89\templates\model\Generator',
            'templates' => [
                'default' => '@antonyz89/templates/model/default', // add default template
            ]
        ],
        'crud' => [
            'class' => 'antonyz89\templates\crud\Generator',
            'templates' => [
                'admin-lte' => '@antonyz89/templates/crud/admin-lte', // add default template
            ]
        ]
    ],
];

return $config;
