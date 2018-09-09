<?php

namespace AppBundle\Form\Type\AvatarModel;


use AppBundle\Entity\AvatarModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvatarModelsType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choice_label' => false,
            'class' => AvatarModel::class,
            'expanded' => true,
            'multiple' => true,
            'required' => false,
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

    }

    public function getParent()
    {
        return EntityType::class;
    }

    public function getBlockPrefix()
    {
        return 'app_form_type_avatar_models';
    }
}
