<?php

namespace AppBundle\Form\Type\Admin\Image\Edition;

use AppBundle\Entity\Image;
use AppBundle\Form\Type\Admin\Uploaded\Edition\EditionUploadedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditionImageType extends EditionUploadedType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Image::class,
        ));
    }
}