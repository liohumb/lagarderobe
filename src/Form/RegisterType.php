<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType // crée avec la commande symfony console make:form
{
    public function buildForm(FormBuilderInterface $builder, array $options) // fonction qui permet de construire des formulaires
    {
        $builder // Builder qui permet de générer les inputs du formulaire
            ->add('firstname', TextType::class, [ // Textype, soit le type de l'input
                'label' => false, // choix du label, ici aucun
                'constraints' => new Length([ // nombre de caractères minimum et maximum
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Votre prénom' // placeholder, soit le text grissé dans les champs d'écriture
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('email', EmailType::class, [ // Emailtype, soit un input de type email avec l'obligation d'entrée une adresse em@il
                'label' => false,
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 60
                ]),
                'attr' => [
                    'placeholder' => 'Votre adresse email'
                ]
            ])
            ->add('password', RepeatedType::class, [ // RepeatedType va répéter l'input password ce qui va permettre de rajouter une confirmation de mot de passe
                'type' => PasswordType::class, // Passwordtype, soit un input qui va mettre des point • à la place des caractères
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique', // Message en cas d'érreurs de saisi
                'label' => false,
                'required' => true, // required, soit que l'input est obligatoire pour valider le formulaire
                'first_options' => [ // premier input password
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Votre mot de passe'
                    ]
                ],
                'second_options' => [ // second input password
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Merci de confirmez votre mot de passe'
                    ]
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
