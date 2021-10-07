<?php

namespace App\Controller\Admin;

use App\Entity\Information;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InformationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Information::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nameLink', 'Nom sur les réseaux'),
            TextField::new('btnFacebook', 'Lien Facebook'),
            TextField::new('btnInstagram', 'Lien Instagram'),
            TextField::new('btnTwitter', 'Lien Twitter'),
            TelephoneField::new('phone', 'Numéro de téléphone'),
            ImageField::new('firstIllustration', 'Première image')
                ->setBasePath('uploads/')
                ->setUploadDir('/public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ImageField::new('secondIllustration', 'Deuxième image')
                ->setBasePath('uploads/')
                ->setUploadDir('/public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('firstDay', "Premier jour d'ouverture"),
            TextField::new('lastDay', "Dernier jour d'ouverture"),
            TextField::new('openHour', "Horaire d'ouverture"),
            TextField::new('closeHour', 'Heure de fermeture'),
            TextField::new('btnTitle', 'Titre du bouton'),
            TextField::new('btnUrl', 'Lien du bouton')
        ];
    }

}
