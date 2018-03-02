<?php

namespace Tutorial\Service;

use Tutorial\Service\GreetingServiceInterface;

class GreetingService implements GreetingServiceInterface
{
    public function getGreeting()
    {
        $output = '';

        $dt = new \DateTime();
        $dt->setTimezone(new \DateTimeZone('America/New_York'));
        $hour = $dt->format('G');

        if ($hour > 5 && $hour <= 11) {
            $output = 'Good morning, world!';
        } elseif ($hour > 11 && $hour <= 17) {
            $output = 'Good day, world!';
        } elseif ($hour > 17 && $hour <= 23) {
            $output = 'Good evening, world!';
        } else {
            $output = 'Good night, world!';
        }

        return $output;
    }
}
