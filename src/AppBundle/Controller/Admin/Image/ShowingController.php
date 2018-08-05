<?php

namespace AppBundle\Controller\Admin\Image;

use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowingController extends Controller
{
    public function showImageAction(Image $image)
    {
        return $this->render('@Page/Admin/Image/Showing/show.html.twig', array(
            'image' => $image,
        ));
    }
}
