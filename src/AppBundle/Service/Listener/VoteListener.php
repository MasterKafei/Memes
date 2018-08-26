<?php

namespace AppBundle\Service\Listener;


use AppBundle\Entity\Vote;
use Doctrine\ORM\Event\LifecycleEventArgs;

class VoteListener
{
    public function prePersist(Vote $vote, LifecycleEventArgs $args)
    {
        if($vote->getUser()) {
            $vote->setUserIp(null);
        }
    }
}
