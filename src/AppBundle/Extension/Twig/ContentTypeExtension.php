<?php

namespace AppBundle\Extension\Twig;


use AppBundle\Entity\Content;
use AppBundle\Entity\Image;
use AppBundle\Entity\Video;
use AppBundle\Entity\YoutubeLink;

class ContentTypeExtension extends \Twig_Extension
{
    public function getTests()
    {
        return array(
            new \Twig_SimpleTest('image', array($this, 'isImage')),
            new \Twig_SimpleTest('video', array($this, 'isVideo')),
            new \Twig_SimpleTest('youtube_link', array($this, 'isYoutubeLink')),
        );
    }

    public function isImage(Content $content)
    {
        return $content instanceof Image;
    }

    public function isVideo(Content $content)
    {
        return $content instanceof Video;
    }

    public function isYoutubeLink(Content $content)
    {
        return $content instanceof YoutubeLink;
    }
}
