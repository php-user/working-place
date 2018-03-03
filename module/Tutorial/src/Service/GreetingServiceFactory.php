<?php

namespace Tutorial\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class GreetingServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $container->get('ModuleManager')->getEventManager()->getSharedManager()->attach(
            'greetingIdentifier',
            'getGreeting',
            function ($event) use ($container) {
                $params = $event->getParams();
                $container->get('someService')->onGetGreeting($params);
            }
        );

        $greetingService = new GreetingService();
        $greetingService->setEventManager($container->get('EventManager'));

        /*$greetingService->getEventManager()->attach(
            'getGreeting',
            function ($event) use ($container) {
                //$hour = $event->getParam('hour');
                $params = $event->getParams();
                $container->get('someService')->onGetGreeting($params);
            }
        );*/


        //$greetingAggregate = $container->get('greetingAggregate');
        //$greetingAggregate->attach($greetingService->getEventManager());

        return $greetingService;
    }
}
