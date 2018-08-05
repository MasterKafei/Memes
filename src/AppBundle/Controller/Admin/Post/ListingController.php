<?php

namespace AppBundle\Controller\Admin\Post;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listPostAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('@Page/Admin/Post/Listing/list.html.twig', array(
            'posts' => $posts,
        ));
    }
}
