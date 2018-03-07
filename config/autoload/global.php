<?php

use Zend\Mvc\I18n\Translator;

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
    ]
];
