<?php

namespace AppBundle\Entity;

/**
 * Post
 */
class Post
{
    /**
     * @var int
     */
    private $id;

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
     * @var int
     */
    private $numberOfLikes;

    /**
     * @var int
     */
    private $numberOfFavorites;

    /**
     * @var bool
     */
    private $published;


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
     * Set numberOfLikes.
     *
     * @param int $numberOfLikes
     *
     * @return Post
     */
    public function setNumberOfLikes($numberOfLikes)
    {
        $this->numberOfLikes = $numberOfLikes;

        return $this;
    }

    /**
     * Get numberOfLikes.
     *
     * @return int
     */
    public function getNumberOfLikes()
    {
        return $this->numberOfLikes;
    }

    /**
     * Set numberOfFavorites.
     *
     * @param int $numberOfFavorites
     *
     * @return Post
     */
    public function setNumberOfFavorites($numberOfFavorites)
    {
        $this->numberOfFavorites = $numberOfFavorites;

        return $this;
    }

    /**
     * Get numberOfFavorites.
     *
     * @return int
     */
    public function getNumberOfFavorites()
    {
        return $this->numberOfFavorites;
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
