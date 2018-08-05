<?php

namespace AppBundle\Controller\User;

use AppBundle\Form\Type\User\AuthenticateUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends Controller
{
    public function authenticateAction(Request $request, AuthenticationUtils $utils)
    {
        $form = $this->createForm(AuthenticateUserType::class);
        $error = $utils->getLastAuthenticationError();
        if ($error !== null) {
            echo $error->getMessage();
        }

        $lastUsername = $utils->getLastUsername();
        $form->get('_username')->setData($lastUsername);
        $form->get('_csrf_token')->setData(
            $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
        );
        if (null !== $request->query->get('referer')) {
            $form->get('_target_path')->setData($request->query->get('referer'));
        }

        return $this->render('@Page/User/Authentication/authenticate.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function checkAction()
    {
        throw new \RuntimeException('Should never be called');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('Should never be called');
    }
}
