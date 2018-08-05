<?php

namespace AppBundle\Controller\Admin\YoutubeLink;

use AppBundle\Entity\YoutubeLink;
use AppBundle\Form\Type\Admin\YoutubeLink\Creation\CreationYoutubeLinkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createYoutubeLinkAction(Request $request)
    {
        $youtubeLink = new YoutubeLink();

        $form = $this->createForm(CreationYoutubeLinkType::class, $youtubeLink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($youtubeLink);
            $em->flush();

            return $this->redirectToRoute('app_admin_youtube_link_listing_list_youtube_link');
        }

        return $this->render('@Page/Admin/YoutubeLink/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
