<?php

namespace AppBundle\Service\Util\Console;

use AppBundle\Service\Util\AbstractContainerAware;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class Console
 * @package AppBundle\Service\Util\Console
 */
class Console extends AbstractContainerAware
{
    protected static $messageIcons = array(
        Message::TYPE_SUCCESS => 'fas fa-check',
        Message::TYPE_INFO => 'fas fa-info-circle',
        Message::TYPE_WARNING => 'fas fa-exclamation-triangle',
        Message::TYPE_DANGER => 'fas fa-times',
    );

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var array
     */
    protected $messages;

    /**
     * @var int
     */
    protected $index;

    /**
     * Console constructor.
     */
    public function __construct()
    {
        $this->index = 0;
    }

    /**
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
        $this->session->start();
        $this->messages = $this->session->getFlashBag()->get('console_messages');
        if (null === $this->messages) {
            $this->messages = array();
        }
    }

    /**
     * Add a message to the console
     *
     * @param string $message Content of the message
     * @param string $type Type of the message (SUCCESS|INFO|WARNING|DANGER)
     * @param string $icon Icon of the message (fa awesome)
     */
    public function add($message, $type = Message::TYPE_INFO, $icon = null)
    {
        if (!$icon) {
            $icon = self::$messageIcons[$type];
        }

        $this->messages[] = new Message($message, $type, $icon);
        $this->saveMessages();
    }

    /**
     * @return Message[]
     * @throws \Exception
     */
    public
    function getMessages()
    {
        $messages = $this->messages;
        $this->messages = array();
        $this->saveMessages();
        
        return $messages;
    }

    /**
     * Save Messages to be retrieved through session
     */
    protected
    function saveMessages()
    {
        $this->session->getFlashBag()->set('console_messages', $this->messages);
    }
}
