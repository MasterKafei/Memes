<?php

namespace AppBundle\Entity;

class Comment
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
     * @var string
     */
    private $text;

    /**
     * @var Commentable
     */
    private $target;

    /**
     * @var \DateTime
     */
    private $postedDate;

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
     * Get user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user.
     *
     * @param User $user
     *
     * @return Comment
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get target.
     *
     * @return Commentable
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set target.
     *
     * @param Commentable $target
     * @return Comment
     */
    public function setTarget($target)
    {
        if ($target instanceof Comment) {
           if ($target->getTarget() instanceof Comment)
           {
               return $this;
           }
        }

        $this->target = $target;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get postedDate.
     *
     * @return \DateTime
     */
    public function getPostedDate()
    {
        return $this->postedDate;
    }

    /**
     * Set postedDate.
     *
     * @param \DateTime $postedDate
     *
     * @return Comment
     */
    public function setPostedDate($postedDate)
    {
        $this->postedDate = $postedDate;

        return $this;
    }
}
