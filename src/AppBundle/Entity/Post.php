<?php

namespace AppBundle\Entity;

/**
 * Post
 */
class Post extends Commentable
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var Content
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $lastUpdate;

    /**
     * @var LikeVote[]
     */
    private $likeVotes;

    /**
     * @var FavoriteVote[]
     */
    private $favoriteVotes;

    /**
     * @var bool
     */
    private $published;

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Post
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Post
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set content.
     *
     * @param Content $content
     * @return Post
     */
    public function setContent(Content $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set lastUpdate.
     *
     * @param \DateTime $lastUpdate
     *
     * @return Post
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate.
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set likeVotes.
     *
     * @param LikeVote[] $likeVotes
     *
     * @return Post
     */
    public function setLikeVotes($likeVotes)
    {
        $this->likeVotes = $likeVotes;

        return $this;
    }

    /**
     * Get likeVotes.
     *
     * @return LikeVote[]
     */
    public function getLikeVotes()
    {
        return $this->likeVotes;
    }

    /**
     * Set favoriteVotes.
     *
     * @param FavoriteVote[] $favoriteVotes
     *
     * @return Post
     */
    public function setFavoriteVotes($favoriteVotes)
    {
        $this->favoriteVotes = $favoriteVotes;

        return $this;
    }

    /**
     * Get favoriteVotes.
     *
     * @return FavoriteVote[]
     */
    public function getFavoriteVotes()
    {
        return $this->favoriteVotes;
    }

    /**
     * Set published.
     *
     * @param $published
     *
     * @return Post
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published.
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
    }
}
