<?php

namespace App\Controller\Admin;

use App\Entity\Hero;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HeroCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hero::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre du Hero'),
            TextareaField::new('content', 'Sous titre ou description'),
            TextField::new('btnTitle','Titre du bouton'),
            TextField::new('btnUrl', 'Url du bouton'),
            ImageField::new('illustration', 'Image du Hero')
                ->setBasePath('uploads/')
                ->setUploadDir('/public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }

}
