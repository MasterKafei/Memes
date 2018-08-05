<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function homeAction($category = 'latest')
    {
        return $this->render('@Page/Home/home.html.twig', array(
            'category' => $category,
        ));
    }
}
