<?php

namespace AppBundle\Service\Mailer\User;

use AppBundle\Entity\User;
use AppBundle\Service\Mailer\AbstractMailer;

class RegistrationMailer extends AbstractMailer
{
    /**
     * @param User $user
     */
    public function sendRegisterMail(User $user)
    {
        $template = '@Mail/User/Registration/register.html.twig';

        $context = array(
            'user' => $user,
        );

        $this->sendMail($template, $context, $user->getEmail());
    }
}
