<?php

namespace AppBundle\Controller\Achievement;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listAchievementAction()
    {
        $achievements = $this->container->get('app.business.achievement')->getUserAchievements();

        return $this->render('@Page/Achievement/Listing/list.html.twig', array(
            'achievements' => $achievements,
        ));
    }
}
