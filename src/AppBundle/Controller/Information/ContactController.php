<?php

namespace AppBundle\Controller\Information;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Page/Information/Contact/index.html.twig');
    }
}
