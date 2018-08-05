<?php

namespace AppBundle\Controller\Admin\Video;

use AppBundle\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowingController extends Controller
{
    public function showVideoAction(Video $video)
    {
        return $this->render('@Page/Admin/Video/Showing/show.html.twig', array(
            'video' => $video,
        ));
    }
}
