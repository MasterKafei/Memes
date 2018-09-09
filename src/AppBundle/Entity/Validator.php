<?php

namespace AppBundle\Entity;

/**
 * Validator
 */
class Validator
{
    const LIKE_VOTE_TYPE = 'like_vote';
    const FAVORITE_VOTE_TYPE = 'favorite_vote';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $service;

    /**
     * @var array
     */
    private $parameters;

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
     * Set service.
     *
     * @param string $service
     *
     * @return Validator
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service.
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set parameters.
     *
     * @param array $parameters
     *
     * @return Validator
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Get parameters.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}