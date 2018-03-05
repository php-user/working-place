<?php

namespace Tutorial\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

class GetTime extends AbstractHelper
{
    public function __invoke()
    {
        $dt = new \DateTime('now', new \DateTimeZone('America/New_York'));
        return $dt->format('H:i:s');
    }

}
