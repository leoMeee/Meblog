<?php
$config = [
    'id' => 'basic',
    'basePath' => '/var/www/html',
    'vendorPath' => '/var/www/vendor',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/ShangHai',
    'defaultRoute' => 'post/index',
    'modules' => [
        'backend' => [
            'class' => 'app\modules\backend\Module',
        ]
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\ApcCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => \DockerEnv::dbDsn(),
            'username' => \DockerEnv::dbUser(),
            'password' => \DockerEnv::dbPassword(),
            'charset' => 'utf8',
            'tablePrefix' => '',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => \DockerEnv::get('SMTP_HOST'),
                'username' => \DockerEnv::get('SMTP_USER'),
                'password' => \DockerEnv::get('SMTP_PASSWORD'),
            ],
        ],
        'log' => [
            'traceLevel' => \DockerEnv::get('YII_TRACELEVEL', 0),
            'targets' => [
                [
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stdout',
                    'levels' => ['info', 'trace'],
                    'logVars' => [],
                ],
                [
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stderr',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => \DockerEnv::get('COOKIE_VALIDATION_KEY', null, !YII_ENV_TEST),
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'forceCopy' => YII_ENV_DEV,
        ],
    ],
    'params' => require('/var/www/html/config/params.php'),
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
