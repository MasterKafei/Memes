<?php

namespace AppBundle\Entity;

/**
 * Achievement
 */
class Achievement
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var AchievementModel
     */
    private $model;

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
     * Set user.
     *
     * @param User $user
     *
     * @return Achievement
     */
    public function setUser($user)
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

    /**
     * Set model.
     *
     * @param AchievementModel $model
     *
     * @return Achievement
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model.
     *
     * @return AchievementModel
     */
    public function getModel()
    {
        return $this->model;
    }
}
