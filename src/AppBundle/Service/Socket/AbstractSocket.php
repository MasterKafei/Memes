<?php

namespace AppBundle\Service\Socket;

use AppBundle\Service\Util\AbstractContainerAware;
use Ratchet\Wamp\Topic;

abstract class AbstractSocket extends AbstractContainerAware
{
    /**
     * Send data to the current user.
     *
     * @param $data
     * @param $route
     * @param array $routeArguments
     */
    public function sendDataToCurrentUser($data, $route, $routeArguments = array())
    {
        $this->container->get('gos_web_socket.zmq.pusher')->push($data, $route, $routeArguments);
    }
}
