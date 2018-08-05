<?php

namespace AppBundle\Form\Type\Admin\Post\Edition;


use AppBundle\Entity\Content;
use AppBundle\Entity\Image;
use AppBundle\Entity\Video;
use AppBundle\Form\Type\Admin\Content\Edition\EditionUploadedType;
use AppBundle\Form\Type\Admin\Image\Edition\EditionImageType;
use AppBundle\Form\Type\Admin\Video\Edition\EditionVideoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EditionPostType extends AbstractType
{
    private $formContentType = array(
        Video::class => EditionVideoType::class,
        Image::class => EditionImageType::class,
    );

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => false,
            ))
            ->add('description', TextareaType::class, array(
                'required' => false,
            ))
            ->add('content', $this->getEditFormType($builder->getData()))
            ->add('published', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('submit', SubmitType::class);
    }

    private function getEditFormType(Content $content)
    {
        foreach ($this->formContentType as $key => $item) {
            if ($content instanceof $key) {
                return $item;
            }
        }

        return EditionUploadedType::class;
    }
}
