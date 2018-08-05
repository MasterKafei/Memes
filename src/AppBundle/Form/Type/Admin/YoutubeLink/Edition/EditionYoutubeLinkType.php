<?php

namespace AppBundle\Form\Type\Admin\YoutubeLink\Edition;

use AppBundle\Entity\YoutubeLink;
use AppBundle\Form\Type\Admin\Link\Edition\EditionLinkType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditionYoutubeLinkType extends EditionLinkType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => YoutubeLink::class,
        ));
    }
}
