<?php

namespace Tutorial;

use Tutorial\Controller\IndexControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Regex;
use Zend\Router\Http\Method;
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
                    'translate' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/translate[/:action]',
                            'constraint'    => [
                                'action' => '[a-z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\TranslateController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'sample' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/sample[/:action]',
                            'constraint'    => [
                                'action' => '[a-z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\SampleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'ajax' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/ajax[/:action]',
                            'constraint'    => [
                                'action' => '[a-z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\AjaxController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    /*'article' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/articles[/:action[/:id]]',
                            'constraint'    => [
                                'action' => '[a-z]+',
                                'id'     => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],*/
                    /*'article' => [
                        'type' => Regex::class,
                        'options' => [
                            'regex'   => '/articles(/(?<action>[a-z]+)(/(?<id>[0-9]+))?)?',
                            'spec' => '/%action%',
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],*/

                    'article' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/article[/:action][/:id]',
                            'constraints'    => [
                                'action' => '[a-z]+',
                                'id'     => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],

                    'articleAdd' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/article-add',
                            'constraints'    => [
                                'action' => '[a-z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                        'child_routes' => [
                            'addGet' => [
                                'type' => Method::class,
                                'options' => [
                                    'verb'    => 'get',
                                    'defaults' => [
                                        'controller' => Controller\ArticleController::class,
                                        'action'     => 'add',
                                    ],
                                ],
                            ],
                            'addPost' => [
                                'type' => Method::class,
                                'options' => [
                                    'verb'    => 'post',
                                    'defaults' => [
                                        'controller' => Controller\ArticleController::class,
                                        'action'     => 'addPost',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'articleEdit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/article-edit[/:id]',
                            'constraints'    => [
                                'id'     => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                        'child_routes' => [
                            'editGet' => [
                                'type' => Method::class,
                                'options' => [
                                    'verb'    => 'get',
                                    'defaults' => [
                                        'controller' => Controller\ArticleController::class,
                                        'action'     => 'edit',
                                    ],
                                ],
                            ],
                            'editPost' => [
                                'type' => Method::class,
                                'options' => [
                                    'verb'    => 'post',
                                    'defaults' => [
                                        'controller' => Controller\ArticleController::class,
                                        'action'     => 'editPost',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'shuffle' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/shuffle[/:action]',
                            'constraints'    => [
                                'action' => '[a-z]+'
                            ],
                            'defaults' => [
                                'controller' => Controller\ShuffleController::class,
                                'action'     => rand(0, 1) ? 'rand1' : 'rand2',
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
            //Controller\IndexController::class => IndexControllerFactory::class,
            Controller\ExampleController::class => InvokableFactory::class,
            Controller\ArticleController::class => InvokableFactory::class,
            Controller\ShuffleController::class => InvokableFactory::class,
            Controller\TranslateController::class => InvokableFactory::class,
            Controller\SampleController::class => InvokableFactory::class,
            Controller\AjaxController::class => InvokableFactory::class,
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

    /*'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'base_dir' => __DIR__.'/../languages/phpArray',
                'type'     => 'phpArray',
                'pattern'  => '%s.php',
            ],
            [
                'base_dir' => __DIR__.'/../languages/gettext',
                'type'     => 'gettext',
                'pattern'  => '%s.mo',
            ],
        ],
    ],*/
];
