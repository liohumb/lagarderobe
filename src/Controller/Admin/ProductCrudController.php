<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('gender', 'Genre'),
            TextField::new('name', 'Nom'),
            SlugField::new('slug')
                ->setTargetFieldName('name'),
            ImageField::new('illustration', 'Photo')
                ->setBasePath('uploads/')
                ->setUploadDir('/public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('subtitle', 'Sous titre'),
            TextareaField::new('description'),
            BooleanField::new('isBest', 'Tendance'),
            MoneyField::new('price', 'Prix')
                ->setCurrency('EUR'),
            AssociationField::new('category', 'Catégorie')
        ];
    }

}
