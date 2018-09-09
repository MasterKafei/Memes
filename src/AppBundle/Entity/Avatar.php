<?php

namespace AppBundle\Entity;

/**
 * Avatar
 */
class Avatar
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var AvatarModel
     */
    private $model;

    /**
     * @var User
     */
    private $user;


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
     * Set model.
     *
     * @param AvatarModel $model
     *
     * @return Avatar
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model.
     *
     * @return AvatarModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set user.
     *
     * @param User $user
     *
     * @return Avatar
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
}
