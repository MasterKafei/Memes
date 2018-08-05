<?php

namespace AppBundle\Controller\Admin\YoutubeLink;

use AppBundle\Entity\YoutubeLink;
use AppBundle\Form\Type\Admin\YoutubeLink\Edition\EditionYoutubeLinkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editYoutubeLinkAction(Request $request, YoutubeLink $link)
    {
        $form = $this->createForm(EditionYoutubeLinkType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();
        }

        return $this->render('@Page/Admin/YoutubeLink/Edition/edit.html.twig', array(
            'form' => $form,
        ));
    }
}
