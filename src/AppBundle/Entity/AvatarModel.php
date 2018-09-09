<?php

namespace AppBundle\Entity;

/**
 * AvatarModel
 */
class AvatarModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Image
     */
    private $image;

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
     * Get image.
     *
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image.
     *
     * @param Image $image
     *
     * @return AvatarModel
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
