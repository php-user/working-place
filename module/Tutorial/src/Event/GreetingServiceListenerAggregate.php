<?php

namespace Tutorial\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Tutorial\Service\SomeServiceInterface;
use Zend\EventManager\Event;

class GreetingServiceListenerAggregate implements ListenerAggregateInterface
{
    private $someEvent;
    private $listeners = [];

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach( 'getGreeting', [$this, 'event1'], $priority);
        $this->listeners[] = $events->attach( 'getGreeting', [$this, 'event2'], 2);
        $this->listeners[] = $events->attach( 'getGreeting', [$this, 'event3'], 3);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            $events->detach($listener);
            unset($this->listeners[$index]);
        }
    }

    public function setSomeEvent(SomeServiceInterface $someEvent)
    {
        $this->someEvent = $someEvent;
    }

    public function getSomeEvent()
    {
        return $this->someEvent;
    }

    public function event1(Event $e)
    {
        $params = $e->getParams();
        $this->getSomeEvent()->onGetGreeting($params);
    }

    public function event2(Event $e)
    {
        $params = $e->getParams();
        $this->getSomeEvent()->onGetGreeting($params);
    }

    public function event3(Event $e)
    {
        $params = $e->getParams();
        $this->getSomeEvent()->onGetGreeting($params);
    }
}
