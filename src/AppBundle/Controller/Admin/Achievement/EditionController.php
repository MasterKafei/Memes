<?php

namespace AppBundle\Controller\Admin\Achievement;


use AppBundle\Form\Model\Admin\Achievement\Edition\EditAchievementModel;
use AppBundle\Form\Type\Admin\Achievement\Edition\EditAchievementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editAchievementAction(Request $request, $identifier)
    {
        $achievementBusiness = $this->get('app.business.achievement');
        $achievement = $achievementBusiness->getAchievement($identifier);

        $form = $this->createForm(EditAchievementType::class, $achievement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $achievementBusiness->saveAchievement($achievement);
            return $this->redirectToRoute('app_achievement_listing_list_achievement');
        }

        return $this->render('@Page/Admin/Achievement/Edition/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}