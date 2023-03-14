<?php

declare(strict_types=1);

namespace App\Common\From;

use App\Common\DTO\UserDTOInterface;
use App\Common\DTO\UserRegistrationDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('type', ChoiceType::class, ['choices' => [
                'Client' => UserDTOInterface::TYPE_CLIENT,
                'Salesman' => UserDTOInterface::TYPE_SALESMAN,
            ], 'required' => true, 'placeholder' => 'All types', 'attr' => ['onchange' => 'this.form.submit()']]);
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserRegistrationDTO::class,
        ]);
    }
}
