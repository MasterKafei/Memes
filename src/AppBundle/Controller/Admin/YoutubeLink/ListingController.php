<?php

namespace AppBundle\Controller\Admin\YoutubeLink;


use AppBundle\Entity\YoutubeLink;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listYoutubeLinkAction()
    {
        $links = $this->getDoctrine()->getRepository(YoutubeLink::class)->findAll();

        return $this->render('@Page/Admin/YoutubeLink/Listing/list.html.twig', array(
            'links' => $links,
        ));
    }
}
