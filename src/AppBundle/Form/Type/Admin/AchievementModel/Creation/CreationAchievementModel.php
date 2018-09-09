<?php

namespace AppBundle\Form\Type\Admin\AchievementModel\Creation;


use AppBundle\Entity\AchievementModel;
use AppBundle\Form\Type\Admin\Image\Creation\CreationImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationAchievementModel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => false,
            ))
            ->add('description', TextareaType::class, array(
                'required' => false,
            ))
            ->add('image', CreationImageType::class, array(
                'required' => false,
            ))
            ->add('submit', SubmitType::class, array(

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AchievementModel::class,
        ));
    }
}
