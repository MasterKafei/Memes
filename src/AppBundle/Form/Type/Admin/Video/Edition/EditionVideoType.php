<?php

namespace AppBundle\Form\Type\Admin\Video\Edition;

use AppBundle\Entity\Video;
use AppBundle\Form\Type\Admin\Uploaded\Edition\EditionUploadedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditionVideoType extends EditionUploadedType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Video::class,
        ));
    }
}
