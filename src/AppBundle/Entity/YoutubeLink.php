<?php

namespace AppBundle\Entity;


class YoutubeLink extends Link
{
    const TYPE = 'youtube_link';

    public function getVideoId()
    {
        parse_str(parse_url($this->getUri(), PHP_URL_QUERY), $output);
        echo $output['v'];
    }
}