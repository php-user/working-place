<?php

namespace Tutorial;

use Tutorial\Controller\IndexController;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

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

    /*public function init(ModuleManager $moduleManager)
    {
        $moduleManager->getEventManager()->getSharedManager()->attach(
            __NAMESPACE__,
            'dispatch',
            [$this, 'onInit']
        );
    }

    public function onInit()
    {
        echo 'On init';
    }*/

    /*public function onBootstrap(MvcEvent $event)
    {
        $event->getApplication()->getEventManager()->getSharedManager()->attach(
            __NAMESPACE__,
            'dispatch',
            function($e) {
                $controller = $e->getTarget();
                $controller->layout('layout/layoutSecond');
            }
        );
    }*/
}
