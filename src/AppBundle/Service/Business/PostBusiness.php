<?php

namespace AppBundle\Service\Business;


use AppBundle\Entity\Post;
use AppBundle\Service\Util\AbstractContainerAware;

class PostBusiness extends AbstractContainerAware
{
    public function getRandomPost($number = 3, Post $currentPost = null)
    {
        $avoid = array();
        if ($currentPost) {
            $avoid[] = $currentPost->getId();
        }
        return $this->container->get('doctrine')->getRepository(Post::class)->getRandomPost($number, $avoid);
    }
}
