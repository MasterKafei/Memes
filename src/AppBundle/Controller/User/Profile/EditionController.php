<?php

namespace AppBundle\Controller\User\Profile;


use AppBundle\Entity\User;
use AppBundle\Form\Type\User\Profile\EditProfileUserType;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editProfileAction(Request $request)
    {
        $form = $this->createForm(EditProfileUserType::class, $this->getUser());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actualPassword = $form->get('actualPassword')->getData();

            if ($this->get('app.business.user')->isPasswordValid($this->getUser(), $actualPassword)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($this->getUser());
                $em->flush();
            } else {
                $this->get('app.util.console')->add('Not actual password', Message::TYPE_DANGER);
            }
        }

        return $this->render('@Page/User/Profile/Edition/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
