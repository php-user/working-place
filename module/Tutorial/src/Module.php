<?php

namespace Tutorial;

use Tutorial\Controller\IndexController;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'greetingService'   => Service\GreetingServiceFactory::class,
                'greetingAggregate' => Event\GreetingServiceListenerAggregateFactory::class,
            ],
            'invokables' => [
                'someService'     => Service\SomeService::class
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                IndexController::class => function($container) {
                    $cnt = new IndexController();
                    $cnt->setGreetingService($container->get('greetingService'));
                    return $cnt;
                },
            ],
        ];
    }
}
