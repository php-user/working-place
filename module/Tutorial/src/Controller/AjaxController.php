<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AjaxController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function processAction()
    {
        $output         = 'Empty Request';
        $dataFromServer = 'Hello';

        $response = $this->getResponse();
        $request  = $this->getRequest();

        if ($request->isPost()) {
            $firstName = trim(htmlentities($request->getPost('firstname')));
            $lastName  = trim(htmlentities($request->getPost('lastname')));

            if (! empty($firstName) && ! empty($lastName)) {
                $output = $dataFromServer . ' ' . $firstName . ' ' . $lastName;
            }
        }

        $response->setContent(\Zend\Json\Json::encode($output));
        return $response;
    }
}
