<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Form\Type\User\RegistrationUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    public function registerUserAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(RegistrationUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.business.user')->generateToken($user, false);
            $this->get('app.business.user')->hashPassword($user);
            $user->setRoles(array(USER::ROLE_USER));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->get('app.mailer.user.registration')->sendRegisterMail($user);

            return $this->redirectToRoute('app_user_authentication_authenticate');
        }


        return $this->render('@Page/User/Registration/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
