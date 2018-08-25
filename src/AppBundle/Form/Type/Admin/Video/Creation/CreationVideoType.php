<?php

namespace AppBundle\Form\Type\Admin\Video\Creation;

use AppBundle\Entity\Video;
use AppBundle\Form\Type\Admin\Image\Creation\CreationImageType;
use AppBundle\Form\Type\Admin\Uploaded\Creation\CreationUploadedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationVideoType extends CreationUploadedType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('thumbnail', CreationImageType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Video::class,
        ));
    }
}
