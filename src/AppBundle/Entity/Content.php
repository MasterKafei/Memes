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
     * @var Post
     */
    private $post;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set post.
     *
     * @param Post $post
     * @return $this
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post.
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }
}

