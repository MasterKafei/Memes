<?php

namespace AppBundle\Service\Listener;

use AppBundle\Entity\Post;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PostListener
{
    public function prePersist(Post $post, LifecycleEventArgs $args)
    {
        $this->updateLastUpdateDate($post);
        $this->initPostStats($post);
    }

    public function preUpdate(Post $post, LifecycleEventArgs $args)
    {
        $this->updateLastUpdateDate($post);
    }

    private function updateLastUpdateDate(Post $post)
    {
        $post->setLastUpdate(new \DateTime());
    }

    private function initPostStats(Post $post)
    {

    }
}
