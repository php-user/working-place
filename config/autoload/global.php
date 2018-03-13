<?php

use Zend\Mvc\I18n\Translator;


use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Storage\SessionArrayStorage;



return [
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'phparray',
                'base_dir' => getcwd() . '/data/languages/phpArray',
                'pattern'  => '%s.php',
            ],
        ],
    ],

    'service_manager' => [
        'aliases' => [
            'translator' => Translator::class,
        ],
    ],

    'view_helpers' => [
        'invokables' => [
            'translate' => \Zend\I18n\View\Helper\Translate::class
        ]
    ],



    'session_config' => [
        // Срок действия cookie сессии истечет через 1 час.
        'cookie_lifetime' => 60*60*1,
        // Данные сессии будут храниться на сервере до 30 дней.
        'gc_maxlifetime'     => 60*60*24*30,
    ],
        // Настройка менеджера сессий.
        'session_manager' => [
        // Валидаторы сессии (используются для безопасности).
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
        // Настройка хранилища сессий.
        'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
];
