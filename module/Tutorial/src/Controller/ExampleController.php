<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ExampleController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function sampleAction()
    {

        //return $this->redirect()->toUrl('http://rambler.ru');

        return new ViewModel();
    }
}
