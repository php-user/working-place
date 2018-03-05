<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\IndexController;

class ExampleController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->request->isPost('submit')) {
            $this->prg();
        }

        $widget = $this->forward()->dispatch(IndexController::class, ['action' => 'index']);

        $view =  new ViewModel([
            'url' => $this->url()->fromRoute(),
        ]);
        $view->addChild($widget, 'widget');
        //$view->setTemplate('tutorial/example/template');
        return $view;
    }

    public function sampleAction()
    {
        #$successMessage = 'Success message';
        $errorMessage   = 'Error message';

        #$this->flashMessenger()->addSuccessMessage($successMessage);
        $this->flashMessenger()->addErrorMessage($errorMessage);

        $this->redirect()->toRoute('tutorial/example');

        //return $this->redirect()->toUrl('http://rambler.ru');

        //return $this->forward()->dispatch(IndexController::class, ['action' => 'index']);

        //return new ViewModel();
    }
}
