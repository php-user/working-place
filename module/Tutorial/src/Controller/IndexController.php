<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Tutorial\Service\GreetingServiceInterface;

class IndexController extends AbstractActionController
{
    private $greetingService;

    /*public function onDispatch(MvcEvent $e)
    {
        $this->layout('layout/layoutSecond');
        return parent::onDispatch($e);
    }*/

    public function indexAction()
    {
        return new ViewModel([
            //'greeting' => $this->getGreetingService()->getGreeting(),
            'greeting' => 'Hello world!',
        ]);
    }

    public function setGreetingService(GreetingServiceInterface $greetingService)
    {
        $this->greetingService = $greetingService;
    }

    public function getGreetingService()
    {
        return $this->greetingService;
    }
}
