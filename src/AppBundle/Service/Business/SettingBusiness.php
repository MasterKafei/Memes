<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\Setting;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;

class SettingBusiness
{
    const SETTING_USER_NAME_COOKIE = "SETTING_USER_NAME_COOKIE";

    /**
     * @var RequestStack
     */
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getUserSetting(User $user = null)
    {
        return null === $user ? $this->getSettingFromCookie() : $user->getSetting();
    }

    /**
     * Get setting from cookie.
     *
     * @return Setting
     */
    private function getSettingFromCookie()
    {
        $cookies = $this->requestStack->getCurrentRequest()->cookies;

        return $cookies->has(self::SETTING_USER_NAME_COOKIE) ?
            $cookies->get(self::SETTING_USER_NAME_COOKIE) :
            $this->createDefaultSettingEntity();
    }

    /**
     * Create default setting entity.
     *
     * @return Setting
     */
    private function createDefaultSettingEntity()
    {
        return new Setting();
    }
}
