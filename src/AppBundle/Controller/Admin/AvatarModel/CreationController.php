<?php

namespace AppBundle\Controller\Admin\AvatarModel;


use AppBundle\Entity\AvatarModel;
use AppBundle\Form\Type\Admin\AvatarModel\Creation\CreationAvatarModelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createAvatarModelAction(Request $request)
    {
        $avatarModel = new AvatarModel();

        $form = $this->createForm(CreationAvatarModelType::class, $avatarModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avatarModel);
            $em->flush();
        }

        return $this->render('@Page/Admin/AvatarModel/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
