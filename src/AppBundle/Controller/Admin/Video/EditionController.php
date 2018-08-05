<?php

namespace AppBundle\Controller\Admin\Video;

use AppBundle\Entity\Video;
use AppBundle\Form\Type\Admin\Video\Edition\EditionVideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editVideoAction(Request $request, Video $video)
    {
        $form = $this->createForm(EditionVideoType::class, $video);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();

            return $this->redirectToRoute('app_admin_video_listing_list_video');
        }

        return $this->render('@Page/Admin/Video/Edition/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
