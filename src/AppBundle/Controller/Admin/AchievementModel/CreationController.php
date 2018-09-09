<?php

namespace AppBundle\Controller\Admin\AchievementModel;


use AppBundle\Entity\AchievementModel;
use AppBundle\Entity\Reward;
use AppBundle\Entity\Validator;
use AppBundle\Form\Type\Admin\AchievementModel\Creation\CreationAchievementModel;
use AppBundle\Form\Type\Admin\Reward\Creation\CreationRewardType;
use AppBundle\Form\Type\Admin\Validator\Creation\CreationValidatorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createAchievementModelAction(Request $request)
    {
        $achievementModel = new AchievementModel();

        $form = $this->createForm(CreationAchievementModel::class, $achievementModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($achievementModel);
            $em->flush();

            return $this->redirectToRoute('app_admin_achievement_model_listing_list_achievement_model');
        }

        return $this->render('@Page/Admin/AchievementModel/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createRewardAction(Request $request, AchievementModel $model)
    {
        $reward = $model->getReward();
        if (!$reward) {
            $reward = new Reward();
        }

        $form = $this->createForm(CreationRewardType::class, $reward);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $model->setReward($reward);
            $em->persist($model);
            $em->flush();

            return $this->redirectToRoute('app_admin_achievement_model_listing_list_achievement_model');
        }

        return $this->render('@Page/Admin/AchievementModel/Creation/create_reward.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createValidatorsAction(Request $request, AchievementModel $model)
    {
        $validator = new Validator();

        $form = $this->createForm(CreationValidatorType::class, $validator);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $model->addValidator($validator);
            $em->persist($model);
            $em->flush();
        }

        return $this->render('@Page/Admin/AchievementModel/Creation/create_validator.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
