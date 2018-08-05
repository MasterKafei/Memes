<?php

namespace AppBundle\Form\Type\Admin\YoutubeLink\Creation;


use AppBundle\Entity\YoutubeLink;
use AppBundle\Form\Type\Admin\Link\Creation\CreationLinkType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationYoutubeLinkType extends CreationLinkType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => YoutubeLink::class,
        ));
    }
}
