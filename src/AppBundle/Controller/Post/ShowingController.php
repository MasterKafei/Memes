<?php

namespace AppBundle\Controller\Post;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowingController extends Controller
{
    public function showPostAction(Post $post)
    {
        return $this->render('@Page/Post/Showing/show.html.twig', array(
                'post' => $post,
            )
        );
    }
}
