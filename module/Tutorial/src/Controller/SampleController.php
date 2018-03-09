<?php

namespace Tutorial\Controller;

use Zend\Http\Header\SetCookie;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Headers;
use Zend\Http\Response\Stream;
use Zend\Session\Container;

class SampleController extends AbstractActionController
{
    public function indexAction()
    {
        $message = '';

        /*$session = new Container('sessionName');
        $message = $session->message;
        $session->getManager()->getStorage()->clear('sessionName');*/

        $cookie = $this->getRequest()->getCookie('cookieName');
        if ($cookie->offsetExists('cookieName')) {
            $message = $cookie->offsetGet('cookieName');

            $cookie = new SetCookie('cookieName', '', strtotime('-1 day'), '/');
            $this->getResponse()->getHeaders()->addHeader($cookie);
        }

        return new ViewModel([
            'message' => $message,
        ]);
    }

    public function downloadAction()
    {
        $file = getcwd() . '/public_html/img/pic1.jpg';

        if (file_exists($file)) {
            $fileName = basename($file);
            $fileSize = filesize($file);

            $stream = new Stream();
            $stream->setStream(fopen($file, 'r'));
            $stream->setStreamName($fileName);
            $stream->setStatusCode(200);

            $headers = new Headers();
            $headers->addHeaderLine('Content-Type: application/octet-stream');
            $headers->addHeaderLine('Content-Disposition: attachment; filename=' . $fileName);
            $headers->addHeaderLine('Content-Length: ' . $fileSize);
            $headers->addHeaderLine('Cache-Control: no-store, must-revalidate');

            $stream->setHeaders($headers);
            return $stream;
        }
    }

    public function pageAction()
    {
        //$session = new Container('sessionName');
        //$session->message = 'Session message';

        $cookie = new SetCookie('cookieName', 'Cookie message', strtotime('+1 day'), '/');
        $this->getResponse()->getHeaders()->addHeader($cookie);

        return new ViewModel();
    }
}
