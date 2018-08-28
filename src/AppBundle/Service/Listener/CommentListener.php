<?php

namespace AppBundle\Service\Listener;


use AppBundle\Entity\Comment;
use Doctrine\ORM\Event\LifecycleEventArgs;

class CommentListener
{
    public function prePersist(Comment $comment, LifecycleEventArgs $args)
    {
        $comment->setPostedDate(new \DateTime());
    }
}
