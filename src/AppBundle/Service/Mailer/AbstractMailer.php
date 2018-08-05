<?php

namespace AppBundle\Service\Mailer;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class AbstractMailer
 * @package AppBundle\Service\Mailer
 */
abstract class AbstractMailer
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var array
     */
    protected $params;

    /**
     * @param \Swift_Mailer $mailer
     *
     * @return $this
     */
    public function setMailer(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }

    /**
     * @param Router $router
     *
     * @return $this
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
    }

    /**
     * @param \Twig_Environment $twig
     *
     * @return $this
     */
    public function setTwig(\Twig_Environment $twig)
    {
        $this->twig = $twig;

        return $this;
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @param string       $template  Template file path (Twig syntax)
     * @param array        $context   Variables needed in the template file
     * @param array|string $toEmail   Recipient Email address ('email' or array('email' => 'name'))
     * @param array|string $fromEmail Sender Email address ('email' or array('email' => 'name'))
     * @param string       $replyTo   Email address to reply to
     */
    protected function sendMail($template, array $context, $toEmail, $fromEmail = null, $replyTo = null)
    {
        $context = $this->twig->mergeGlobals($context);
        $template = $this->twig->loadTemplate($template);
        $subject = $template->renderBlock('subject', $context);
        $textBody = $template->renderBlock('body_text', $context);
        $htmlBody = $template->renderBlock('body_html', $context);

        if (null === $fromEmail) {
            $fromEmail = array($this->params['sender_address'] => $this->params['sender_name']);
        }

        $message = new \Swift_Message();
        $message->setSubject($subject)->setFrom($fromEmail)->setTo($toEmail);

        if ($replyTo !== null) {
            $message->setReplyTo($replyTo);
        }

        if (!empty($htmlBody)) {
            $message->setBody($htmlBody, 'text/html')->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        $this->mailer->send($message);
    }
}
