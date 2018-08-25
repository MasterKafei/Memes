<?php

namespace AppBundle\Entity;


use AppBundle\Entity\Post;

class LikeVote extends Vote
{
    const TYPE = 'like';

    /**
     * @var Post
     */
    private $post;

    /**
     * Get post.
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set post.
     *
     * @param $post
     * @return Vote
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }
}
