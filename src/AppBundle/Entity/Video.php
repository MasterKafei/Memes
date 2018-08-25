<?php

namespace AppBundle\Entity;


class Video extends Uploaded
{
    const TYPE = 'video';

    /**
     * @var Image
     */
    private $thumbnail;

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $thumbnail;
    }
}
