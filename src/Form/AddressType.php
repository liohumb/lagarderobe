<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Nommez votre adresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Prenom du destinataire'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Nom du destinataire'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => ' ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de la société (falcutatif)'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Adresse'
                ]
            ])
            ->add('postal', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Code postal'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => ' ',
                'preferred_choices' => ['FR'],
                'attr' => [
                    'placeholder' => 'Pays'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
