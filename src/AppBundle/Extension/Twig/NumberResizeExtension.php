<?php

namespace AppBundle\Extension\Twig;


use Twig\TwigFilter;

class NumberResizeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('resizeNumber', array($this, 'resizeNumber')),
        );
    }

    public function resizeNumber($number)
    {
        $numbersFormats = array(
            1000 => 'K',
            1000000 => 'M',
            10000000000 => 'B',
        );

        $finalFormat = '';
        $finalNumber = $number;
        foreach($numbersFormats as $key => $format)
        {
            if($key <= $number) {
                $finalNumber = $number/$key;
                $finalFormat = $format;
            }
        }

        return floor($finalNumber) . $finalFormat;
    }
}
