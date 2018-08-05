<?php

namespace AppBundle\Form\Type\Admin\Video\Creation;

use AppBundle\Entity\Video;
use AppBundle\Form\Type\Admin\Uploaded\Creation\CreationUploadedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationVideoType extends CreationUploadedType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Video::class,
        ));
    }
}
