<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Form\Type\User\ForgotPasswordType;
use AppBundle\Form\Type\User\ResetPassword;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForgotPasswordController extends Controller
{
    public function requestTokenAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(ForgotPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $targetUser = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('email' => $user->getEmail()));
            if ($targetUser) {
                $passwordToken = $this->container->get('app.util.token_generator')->generateToken();
                $targetUser->setPasswordToken($passwordToken);
                $em = $this->getDoctrine()->getManager();
                $em->persist($targetUser);
                $em->flush();
                $this->get('app.mailer.user.forgot_password')->sendForgotPasswordMail($targetUser);
            }
        }

        return $this->render('@Page/User/ForgotPassword/request.html.twig',
            array(
                'form' => $form->createView(),
            ));
    }

    public function checkTokenAction(Request $request, User $user, $token)
    {
        if ($token !== $user->getPasswordToken()) {
            return $this->redirectToRoute('app_home_home');
        }

        $form = $this->createForm(ResetPassword::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->container->get('app.business.user')->hashPassword($user);
            $user->setPasswordToken(null);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_user_authentication_authenticate');
        }

        return $this->render('@Page/User/ForgotPassword/forgot_password.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
