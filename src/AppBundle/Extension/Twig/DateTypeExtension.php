<?php

namespace AppBundle\Extension\Twig;


use Twig\TwigFilter;

class DateTypeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('diffDateTime', array($this, 'diffDateTime')),
        );
    }

    public function diffDateTime($datetime)
    {
        $now = new \DateTime();
        $interval = $datetime->diff($now);

        $days = $interval->d;

        if ($days !== 0) {
            return $days . ' day' . ($days > 1 ? 's' : '');
        }

        $hours = $interval->h;

        if ($hours !== 0) {
            return $hours . ' hour' . ($hours > 1 ? 's' : '');
        }

        $minutes = $interval->i;

        if ($minutes !== 0) {
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '');
        }

        $seconds = $interval->s;

        return $seconds . ' second' . ($seconds > 1 ? 's' : '');
    }
}
