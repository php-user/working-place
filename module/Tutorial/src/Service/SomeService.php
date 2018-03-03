<?php

namespace Tutorial\Service;

use Tutorial\Service\SomeServiceInterface;

class SomeService implements SomeServiceInterface
{
    public function onGetGreeting($value)
    {
        echo 'Some event on "getGreeting" service with value "hour" = ' . $value['hour'];
    }
}
