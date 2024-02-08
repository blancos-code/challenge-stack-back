<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            BooleanField::new('isbanned')->setLabel('Banni')->setRequired(true),
            TextField::new('nom')->setLabel('Nom')->setRequired(true),
            TextField::new('prenom')->setLabel('Prénom')->setRequired(true),
            TextField::new('email')->setLabel('Email')->setRequired(true),
            TextField::new('tel')->setLabel('Téléphone')->setRequired(false),
            TextField::new('adresse')->setLabel('Adresse')->setRequired(true),
            AssociationField::new('commentaireMarches')
            ->setLabel('Commentaires (marchés)')
            ->setRequired(false),
            AssociationField::new('commentaireProducteurs')
            ->setLabel('Commentaires (producteurs)')
            ->setRequired(false),
        ];
    }
}
