<?php
/* @var array() $web the web configuration */
$web = self::webConfig();
return [
    'id' => $web['id'],
    'basePath' => $web['basePath'],
    'vendorPath' => $web['vendorPath'],
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@test' => dirname(__DIR__).'/tests/codeception',
        '@tests/codeception/fixtures' => '@test/fixtures',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'templatePath' => '@test/fixtures/templates',
            'fixtureDataPath' => '@test/fixtures/data',
            'namespace' => 'tests\codeception\fixtures',
            'language' => 'zh_TW',
        ],
    ],
    'components' => [
        'db' => $web['components']['db'],
        'log' => [
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
    ],
    'params' => $web['params'],
];
