<?php

namespace AppBundle\Form\Type\Admin\AvatarModel\Creation;


use AppBundle\Entity\AvatarModel;
use AppBundle\Form\Type\Admin\Image\Creation\CreationImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationAvatarModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', CreationImageType::class, array(

            ))
            ->add('submit', SubmitType::class, array(

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => AvatarModel::class,
            )
        );
    }
}
