<?php

namespace AppBundle\Controller\Admin\Image;

use AppBundle\Entity\Image;
use AppBundle\Form\Type\Admin\Image\Edition\EditionImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editImageAction(Request $request, Image $image)
    {
        $form = $this->createForm(EditionImageType::class, $image);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('app_admin_image_listing_list_image');
        }

        return $this->render('@Page/Admin/Image/Edition/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
