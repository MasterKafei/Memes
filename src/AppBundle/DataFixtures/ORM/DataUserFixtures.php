<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DataUserFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('MasterKafei')
            ->setEmail('toto@tata.com')
            ->setEnabled(true)
            ->setLevel(0)
            ->setRoles(array(
                'ROLE_USER',
                'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN'
            ))
            ->setPlainPassword('toto');

        $manager->persist($user);


        $user = new User();
        $user
            ->setUsername('Craaftx')
            ->setEmail('titi@tutu.com')
            ->setEnabled(true)
            ->setLevel(0)
            ->setRoles(array(
                'ROLE_USER',
                'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN',
            ))
            ->setPlainPassword('toto');

        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 0;
    }
}
