<?php

namespace Tutorial;

use Tutorial\Controller\IndexControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'tutorial' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tutorial',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'example' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/example[/:action]',
                            'constraint'    => [
                                'action' => '[a-z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ExampleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            //Controller\IndexController::class => InvokableFactory::class,
            //Controller\IndexController::class => IndexControllerFactory::class,
            Controller\ExampleController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'tutorial/index/index' => __DIR__ . '/../view/tutorial/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
