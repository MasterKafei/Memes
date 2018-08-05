<?php

namespace AppBundle\Controller\Admin\Image;

use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listImageAction()
    {
        $images = $this->getDoctrine()->getRepository(Image::class)->findAll();

        return $this->render('@Page/Admin/Image/Listing/list.html.twig', array(
            'images' => $images,
        ));
    }
}
