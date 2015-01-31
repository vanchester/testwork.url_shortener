<?php

return [
    'basePath' => __DIR__ . '/..',
    'name' => 'Укротитель ссылок',

    'sourceLanguage' => 'en',
    'language' => 'ru',

    'import' => [
        'application.models.*',
        'application.components.*'
    ],

    'modules' => [],

    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ]
            ]
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'urlManager' => [
            'urlFormat' => 'path',
            'rules' => [
                '<code:\w{5}>' => 'site/redirect'
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
];
