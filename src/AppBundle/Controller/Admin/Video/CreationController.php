<?php

namespace AppBundle\Controller\Admin\Video;

use AppBundle\Entity\Video;
use AppBundle\Form\Type\Admin\Video\Creation\CreationVideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createVideoAction(Request $request)
    {
        $video = new Video();

        $form = $this->createForm(CreationVideoType::class, $video);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();

            return $this->redirectToRoute('app_admin_video_listing_list_video');
        }

        return $this->render('@Page/Admin/Video/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
