<?php

namespace AppBundle\Controller\Admin\Image;

use AppBundle\Entity\Image;
use AppBundle\Form\Type\Admin\Image\Creation\CreationImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createImageAction(Request $request)
    {
        $image = new Image();

        $form = $this->createForm(CreationImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('app_admin_image_listing_list_image');
        }

        return $this->render('@Page/Admin/Image/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
