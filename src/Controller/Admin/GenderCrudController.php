<?php

namespace App\Controller\Admin;

use App\Entity\Gender;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GenderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gender::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name', 'Genre')
        ];
    }

}
