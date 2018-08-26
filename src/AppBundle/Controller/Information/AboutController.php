<?php

namespace AppBundle\Controller\Information;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Page/Information/About/index.html.twig');
    }
}
