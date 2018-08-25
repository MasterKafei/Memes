<?php

namespace AppBundle\Entity;

/**
 * Content
 */
abstract class Content
{
    const TYPE = 'content';

    /**
     * @var int
     */
    private $id;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

