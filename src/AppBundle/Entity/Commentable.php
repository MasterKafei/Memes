<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Comment\CommentableTrait;

abstract class Commentable
{
    use CommentableTrait;

    /**
     * @var int
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
