<?php

namespace AppBundle\Controller\Admin\Video;

use AppBundle\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listVideoAction()
    {
        $videos = $this->getDoctrine()->getRepository(Video::class)->findAll();

        return $this->render('@Page/Admin/Video/Listing/list.html.twig', array(
            'videos' => $videos,
        ));
    }
}
