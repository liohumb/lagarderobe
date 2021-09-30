<?php

namespace App\Form;

use App\Class\Filter;
use App\Entity\Category;
use App\Entity\Gender;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Category::class,
                'multiple' => true
            ])
            ->add('gender', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Gender::class,
                'multiple' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Filter::class,
            'method' => 'GET',
            'crsf_protection' => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}