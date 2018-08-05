<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EnablingController extends Controller
{
    public function enableUserAction(User $user, $token)
    {
        if ($user->getToken() !== $token) {
            throw $this->createNotFoundException();
        }

        $user->setEnabled(true);
        $user->setToken(null);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->render('@Page/User/Enabling/enable.html.twig', array(
            'user' => $user,
        ));
    }
}
