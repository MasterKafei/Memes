<?php

namespace AppBundle\Controller\Admin\AchievementModel;

use AppBundle\Entity\AchievementModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listAchievementModelAction()
    {
        $achievementModels = $this->getDoctrine()->getRepository(AchievementModel::class)->findAll();

        return $this->render('@Page/Admin/AchievementModel/Listing/list.html.twig', array(
            'achievement_models' => $achievementModels,
        ));
    }
}
