<?php

namespace Blog;

use Blog\Controller\IndexController;
use Doctrine\ORM\EntityManager;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                IndexController::class => function ($container) {
                    return new IndexController(
                        $container->get(EntityManager::class)
                    );
                },
            ],
        ];
    }
}
