<?php

namespace AppBundle\Controller\Admin\Image;

use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeletionController extends Controller
{
    public function deleteImageAction(Image $image)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();

        return $this->redirectToRoute('app_admin_image_listing_list_image');
    }
}
