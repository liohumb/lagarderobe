<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('new_password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
            'label' => ' ',
            'required' => true,
            'first_options' => [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Votre nouveau mot de passe'
                ]
            ],
            'second_options' => [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Merci de confirmez votre nouveau mot de passe'
                ]
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
