<?php

namespace Tutorial;

use Tutorial\Controller\IndexController;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\Http;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Session\SessionManager;


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

    public function getControllerPluginConfig()
    {
        return [
            'invokables' => [
                'getDate' => Controller\Plugin\GetDate::class,
            ],
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
                'getTime' => View\Helper\GetTime::class,
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

    public function init(ModuleManagerInterface $moduleManager)
    {
        $moduleManager->getEventManager()->getSharedManager()->attach(
            __NAMESPACE__,
            'dispatch',
            function ($e) {
                $request = $e->getRequest();
                if (! $request instanceof Http\Request) {
                    return;
                }
                $translator = $e->getApplication()->getServiceManager()->get('translator');
                $container = new Container('language');
                $lang = $container->language;
                if (! $lang) {
                    $lang = 'en_US';
                }
                $translator->setLocale($lang);
                $e->getViewModel()->setVariable('language', $lang);
            },
            100
        );
    }
}
