<?php

namespace Blog;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'blog' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/blog',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'a' => [ // Тут мы можем писать всё что угодно. Не важно что тут мы написали 'а' будет работать путь blog/category/id
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/category/[:id]',
                            'constraints'    => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'b' => [ // Тут мы можем писать всё что угодно. Не важно что тут мы написали 'b' будет работать путь blog/page/id
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/page/[:id]',
                            'constraints'    => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'page',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            //Controller\IndexController::class => InvokableFactory::class,
            //Controller\ArticleController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'blog/index/index' => __DIR__ . '/../view/blog/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
