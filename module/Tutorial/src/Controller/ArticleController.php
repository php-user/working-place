<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractActionController
{
    public function indexAction()
    {


        return new ViewModel();
    }

    /*public function addAction()
    {
        if ($this->request->isPost()) {
            $title = $this->request->getPost('title');

            if ($title) {
                $this->flashMessenger()->addSuccessMessage('The article successfully added');
            } else {
                $this->flashMessenger()->addErrorMessage('The article not added');
            }

            return $this->redirect()->toRoute('tutorial/article', ['action' => 'articles']);
        }

        return new ViewModel();
    }*/

    /*public function editAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        if ($this->request->isPost()) {
            $title = $this->request->getPost('title');

            if ($title) {
                $this->flashMessenger()->addSuccessMessage('The article successfully edited');
            } else {
                $this->flashMessenger()->addErrorMessage('The article not eduted');
            }

            return $this->redirect()->toRoute('tutorial/article', ['action' => 'articles']);
        }

        return new ViewModel([
            'id' => $id,
        ]);
    }*/

    public function addAction()
    {
        return [];
    }
    public function addPostAction()
    {
        if ($this->request->isPost()) {
            $title = trim(htmlentities($this->request->getPost('title')));
            $successMessage = 'Article added';
            $errorMessage = 'Article not added';
            if (! empty($title)) {
                $this->flashMessenger()->addSuccessMessage($successMessage);
            } else {
                $this->flashMessenger()->addErrorMessage($errorMessage);
            }
            // For regex
            // return $this->redirect()->toRoute('training/article', ['action' => 'article']);
            return $this->redirect()->toRoute('tutorial/article');
        }
    }
    public function editAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        //echo $id; exit;
        return [];
    }
    public function editPostAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        if ($this->request->isPost()) {
            $title = trim(htmlentities($this->request->getPost('title')));
            $successMessage = 'Article edited';
            $errorMessage = 'Article not edited';
            if (! empty($title)) {
                $this->flashMessenger()->addSuccessMessage($successMessage);
            } else {
                $this->flashMessenger()->addErrorMessage($errorMessage);
            }
            // For regex
            // return $this->redirect()->toRoute('training/article', ['action' => 'article']);
            return $this->redirect()->toRoute('tutorial/article');
        }
    }
}
