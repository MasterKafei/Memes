<?php

namespace AppBundle\Form\Type\Admin\Validator\Creation;

use AppBundle\Entity\Validator;
use AppBundle\Form\Type\Admin\Validator\Parameter\FavoriteVoteParameterType;
use AppBundle\Form\Type\Admin\Validator\Parameter\LikeVoteParameterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationValidatorType extends AbstractType
{
    const LIKE_VOTE_SERVICE = 'app.validator.achievement.like_vote_number';
    const FAVORITE_VOTE_SERVICE = 'app.validator.achievement.favorite_vote_number';

    private static $parameterServiceType = array(
        self::LIKE_VOTE_SERVICE => LikeVoteParameterType::class,
        self::FAVORITE_VOTE_SERVICE => FavoriteVoteParameterType::class,
    );

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('service', ChoiceType::class, array(
                'choices' => array(
                    'Like vote number' => self::LIKE_VOTE_SERVICE,
                    'Favorite vote number' => self::FAVORITE_VOTE_SERVICE,
                ),
                'required' => false,
            ))
            ->add('submit', SubmitType::class);

        $formModifier = function (FormInterface $builder, $service) {
            if ($service !== null) {
                $builder->add('parameters', self::$parameterServiceType[$service]);
            }
        };

        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
                $formModifier($event->getForm(), $event->getData()->getService());
            })
            ->get('service')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($formModifier) {
                $formModifier($event->getForm()->getParent(), $event->getForm()->getData());
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Validator::class,
        ));
    }
}
