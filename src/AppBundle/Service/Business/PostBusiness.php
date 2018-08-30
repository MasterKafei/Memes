<?php

namespace AppBundle\Service\Business;


use AppBundle\Entity\Post;
use AppBundle\Service\Util\AbstractContainerAware;

class PostBusiness extends AbstractContainerAware
{
    public function getRandomPost($number = 3)
    {
        return $this->container->get('doctrine')->getRepository(Post::class)->getRandomPost($number);
    }
}
