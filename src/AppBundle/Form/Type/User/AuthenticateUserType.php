<?php

namespace AppBundle\Form\Type\User;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class AuthenticateUserType extends AbstractType
{
    /**
     * @var RouterInterface
     */
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', TextType::class)
            ->add('_password', PasswordType::class)
            ->add('_remember_me', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('_csrf_token', HiddenType::class)
            ->add('_target_path', HiddenType::class)
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'action' => $this->router->generate('app_user_authentication_check'),
                'method' => 'POST',
                'csrf_protection' => false,
            )
        );
    }

    public function getBlockPrefix()
    {
        return null;
    }
}
