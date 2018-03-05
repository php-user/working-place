<?php

namespace Tutorial\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetDate extends AbstractPlugin
{
    public function __invoke()
    {
        $dt = new \DateTime();
        $dt->setTimezone(new \DateTimeZone('America/New_York'));
        return $dt->format('F j, Y');
    }
}
