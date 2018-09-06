<?php

namespace AppBundle\Service\Listener;


use AppBundle\Entity\User;
use AppBundle\Service\Util\AbstractContainerAware;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UserListener extends AbstractContainerAware
{
    public function prePersist(User $user, LifecycleEventArgs $args)
    {
        $this->updateUserPassword($user);
    }

    public function preUpdate(User $user, LifecycleEventArgs $args)
    {
        $this->updateUserPassword($user);
    }

    private function updateUserPassword(User $user)
    {
        try
        {
            $this->container->get('app.business.user')->hashPassword($user);
        } catch(\Exception $e) {

        }
    }
}
