<?php

namespace AppBundle\Entity;

/**
 * Reward
 */
class Reward
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $xp = 0;

    /**
     * @var AvatarModel[]
     */
    private $avatars = array();


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set xp.
     *
     * @param int $xp
     *
     * @return Reward
     */
    public function setXp($xp)
    {
        $this->xp = $xp;

        return $this;
    }

    /**
     * Get xp.
     *
     * @return int
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * Set avatars.
     *
     * @param AvatarModel[] $avatars
     *
     * @return Reward
     */
    public function setAvatars($avatars)
    {
        $this->avatars = $avatars;

        return $this;
    }

    /**
     * Get avatars.
     *
     * @return AvatarModel[]
     */
    public function getAvatars()
    {
        return $this->avatars;
    }
}
