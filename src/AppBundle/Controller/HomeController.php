<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Post\ListingController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function homeAction($category = ListingController::DEFAULT_CATEGORY_KEY_NAME)
    {
        return $this->render('@Page/Home/home.html.twig', array(
            'category' => $category,
        ));
    }
}
