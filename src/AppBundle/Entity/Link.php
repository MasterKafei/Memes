<?php

namespace AppBundle\Entity;


abstract class Link extends Content
{
    const TYPE = 'link';

    /**
     * @var string
     */
    private $uri;

    /**
     * Get uri.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set uri.
     *
     * @param $uri
     * @return mixed
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $uri;
    }
}
