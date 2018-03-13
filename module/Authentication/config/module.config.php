<?php

namespace Authentication;

use Zend\Router\Http\Literal;
use Zend\Crypt\Password\Bcrypt;
use Application\Entity\User;

return [
    'router' => [
        'routes' => [
            'register' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/register',
                    'defaults' => [
                        'controller' => Controller\RegisterController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\LogoutController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'authentication' => [
            'orm_default' => [
                'identity_class'      => User::class,
                'identity_property'   => 'name',
                'credential_property' => 'password',
                'credential_callable' => function (User $user, $password) {
                    if ((new Bcrypt())->verify($password, $user->getPassword())) {
                        return true;
                    } else {
                        return false;
                    }
                },
            ],
        ],
    ],
];
