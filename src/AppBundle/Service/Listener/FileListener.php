<?php

namespace AppBundle\Service\Listener;


use AppBundle\Entity\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Validator\Constraints\Date;

class FileListener
{
    public function preUpdate(File $file, LifecycleEventArgs $args)
    {
        $this->defineFileLastUpdate($file);
    }

    public function prePersist(File $file, LifecycleEventArgs $args)
    {
        $this->defineFileLastUpdate($file);
    }

    private function defineFileLastUpdate(File $file)
    {
        $file->setLastUpdate(new \DateTime());
    }
}
