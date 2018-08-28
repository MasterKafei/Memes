<?php

namespace AppBundle\Entity\Comment;


use AppBundle\Entity\Comment;

trait CommentableTrait
{
    /**
     * @var Comment[}
     */
    private $comments;

    /**
     * Get comments.
     *
     * @return Comment
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set comments.
     *
     * @param $comments
     * @return CommentableTrait
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Add comments.
     *
     * @param Comment $comment
     * @return CommentableTrait
     */
    public function addComment($comment)
    {
        $this->comments[] = $comment;

        return $this;
    }
}
