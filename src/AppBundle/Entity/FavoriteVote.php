<?php

namespace AppBundle\Entity;


class FavoriteVote extends Vote
{
    const TYPE = 'favorite';

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
