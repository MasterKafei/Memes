<?php

namespace AppBundle\Controller\Post;


use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listMostLatestPostAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findMostLatestPublished();

        return $this->render('@Page/Post/Listing/published.html.twig', array(
            'posts' => $posts,
        ));
    }

    public function listMostLikedPostAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findMostLikedPublished();

        return $this->render('@Page/Post/Listing/published.html.twig', array(
            'posts' => $posts,
        ));
    }

    public function listMostFavoritePostAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findMostFavoritePublished();

        return $this->render('@Page/Post/Listing/published.html.twig', array(
            'posts' => $posts,
        ));
    }

    public function listMostRisingPostAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findMostRisingPublished();

        return $this->render('@Page/Post/Listing/published.html.twig', array(
            'posts' => $posts,
        ));
    }
}