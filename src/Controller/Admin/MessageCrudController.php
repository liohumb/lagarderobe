<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Message::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            EmailField::new('email'),
            TextareaField::new('content', 'Contenu du message')
        ];
    }

}
