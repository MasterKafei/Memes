<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Post;
use AppBundle\Entity\User;

abstract class Vote
{
    const TYPE = 'vote';

    private $id;

    /**
     * @var string
     */
    private $userIp;

    /**
     * @var User
     */
    private $user;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Get userIp.
     *
     * @return string
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * Set userIp.
     *
     * @param $userIp
     * @return Vote
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * Set user.
     *
     * @param User $user
     * @return $this
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
