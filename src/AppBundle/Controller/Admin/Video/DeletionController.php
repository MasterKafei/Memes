<?php

namespace AppBundle\Controller\Admin\Video;

use AppBundle\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeletionController extends Controller
{
    public function deleteVideoAction(Video $video)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($video);
        $em->flush();

        return $this->redirectToRoute('app_admin_video_listing_list_video');
    }
}
