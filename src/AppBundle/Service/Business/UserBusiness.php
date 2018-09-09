<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\User;
use AppBundle\Service\Util\AbstractContainerAware;
use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Ratchet\Wamp\Topic;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class UserBusiness
 * @package AppBundle\Service\Business
 */
class UserBusiness extends AbstractContainerAware
{
    const USER_SESSION_KEY = 'USER_SESSION_KEY';
    const SOCKET_SESSION_ID_KEY = 'SOCKET_SESSION_ID_KEY';

    /**
     * Generate a new token for a defined User
     *
     * @param User $user : User to change the token from
     * @param bool $persist : Should changes be persisted ?
     *
     * @return string : Generated token
     */
    public function generateToken(User $user, $persist = true)
    {
        $token = $this->container->get('app.util.token_generator')->generateToken();
        $user->setToken($token);

        if ($persist) {
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $token;
    }

    /**
     * Authenticate current user as the defined User
     *
     * @param User $user : User to authenticate as
     */
    public function authenticateUser(User $user)
    {
        $token = new UsernamePasswordToken($user, null, 'secured_area', $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);
        $this->container->get('session')->set('_security_secured_area', serialize($token));
    }

    /**
     * Hash a password with hash strategy defined in security
     *
     * @param User $user
     *
     * @return string
     * @throws \Exception
     */
    public function hashPassword(User $user)
    {
        if (null === $user->getPlainPassword()) {
            throw new \Exception('Plain password can\'t be null');
        }

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
        $user->setPassword($password);

        return $password;
    }

    /**
     * Get current authenticated user
     *
     * @return User
     */
    public function getCurrentUser()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        if ($user instanceof User) {
            return $user;
        }

        return null;
    }

    // -------------------------------------------------- //
    // ---------------------- Tests --------------------- //
    // -------------------------------------------------- //

    /**
     * Check if the password is valid
     *
     * @param User $user : Owner
     * @param string $password : Password to check
     *
     * @return bool
     */
    public function isPasswordValid(User $user, $password)
    {
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);

        return $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
    }

    /**
     * Is user password defined.
     *
     * @param User $user
     *
     * @return bool
     */
    public function isUserPasswordDefined(User $user)
    {
        return (null !== $user->getPassword());
    }

    /**
     * Load user.
     *
     * @return User
     */
    public function loadUser()
    {
        $user = $this->getCurrentUser();

        if (!$user) {
            $user = $this->getUserFromSession();
        }

        return $user;
    }

    /**
     * Save user.
     *
     * @param User $user
     */
    public function saveUser(User $user)
    {
        if ($this->isUserRegister($user)) {
            $em = $this->container->get('doctrine')->getManager();
            foreach ($user->getAchievements() as $achievement) {
                $achievement->setUser($user);
                $em->persist($achievement);
            }
            $em->persist($user);
            $em->flush();
        } else {
            $this->setUserToSession($user);
        }
    }

    /**
     * Get user from session.
     *
     * @return User
     */
    private function getUserFromSession()
    {
        $session = $this->container->get('app.business.request')->getMasterRequest()->getSession();
        $user = $session->get(self::USER_SESSION_KEY);

        if (!$user) {
            $user = $this->createNewUserInSession();
        }

        return $user;
    }

    /**
     * Set user to session.
     *
     * @param User $user
     */
    private function setUserToSession(User $user)
    {
        $session = $this->container->get('app.business.request')->getMasterRequest()->getSession();

        $session->set(self::USER_SESSION_KEY, $user);
    }

    /**
     * Create new user in session.
     *
     * @return User
     */
    private function createNewUserInSession()
    {
        $user = new User();
        $user->setSalt(null);
        $this->setUserToSession($user);

        return $user;
    }

    /**
     * Is user register
     *
     * @param User $user
     * @return bool
     */
    public function isUserRegister(User $user)
    {
        return $user->getId() !== null;
    }

    public function getUserXp()
    {
        $achievements = $this->container->get('app.business.achievement')->getUserAchievements();
        $xp = 0;
        foreach ($achievements as $achievement) {
            $xp += $achievement->getReward()->getXp();
        }

        return $xp;
    }

    /**
     * Get socket session id.
     *
     * @return string
     */
    public function getSocketSessionId()
    {
        $id = $this->container->get('session')->get(self::SOCKET_SESSION_ID_KEY);

        if (!$id) {
            $id = $this->defineSocketSessionId();
        }

        return $id;
    }

    /**
     * Define a new socket id the current user session.
     *
     * @return string
     */
    private function defineSocketSessionId()
    {
        $id = $this->container->get('app.util.token_generator')->generateToken();
        $this->container->get('session')->set(self::SOCKET_SESSION_ID_KEY, $id);

        return $id;
    }

}
