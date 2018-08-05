<?php

namespace AppBundle\Form\Type\Admin\Post\Creation;


use AppBundle\Entity\Post;
use AppBundle\Form\Type\Admin\Content\Creation\CreationUploadedType;
use AppBundle\Form\Type\Admin\Image\Creation\CreationImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationPostType extends AbstractType
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
            ->add('content', $options['content_form_type'])
            ->add('published', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class,
            'content_form_type' => CreationImageType::class,
        ));
    }
}
