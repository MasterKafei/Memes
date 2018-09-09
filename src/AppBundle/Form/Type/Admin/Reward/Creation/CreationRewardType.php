<?php

namespace AppBundle\Form\Type\Admin\Reward\Creation;


use AppBundle\Entity\AvatarModel;
use AppBundle\Entity\Reward;
use AppBundle\Form\Type\AvatarModel\AvatarModelsType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationRewardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('xp', IntegerType::class, array(

            ))
            ->add('avatars', AvatarModelsType::class, array(

            ))
            ->add('submit', SubmitType::class, array(

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Reward::class,
        ));
    }
}
