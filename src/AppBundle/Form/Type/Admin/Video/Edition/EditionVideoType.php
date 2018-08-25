<?php

namespace AppBundle\Form\Type\Admin\Video\Edition;

use AppBundle\Entity\Video;
use AppBundle\Form\Type\Admin\Image\Creation\CreationImageType;
use AppBundle\Form\Type\Admin\Image\Edition\EditionImageType;
use AppBundle\Form\Type\Admin\Uploaded\Edition\EditionUploadedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditionVideoType extends EditionUploadedType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('thumbnail', EditionImageType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Video::class,
        ));
    }
}
