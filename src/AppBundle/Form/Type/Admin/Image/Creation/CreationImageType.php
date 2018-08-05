<?php

namespace AppBundle\Form\Type\Admin\Image\Creation;

use AppBundle\Entity\Image;
use AppBundle\Form\Type\Admin\Uploaded\Creation\CreationUploadedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationImageType extends CreationUploadedType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Image::class,
        ));
    }
}
