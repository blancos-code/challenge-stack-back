<?php

namespace App\Controller\Admin;

use App\Entity\CommentaireProducteur;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class CommentaireProducteurCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return CommentaireProducteur::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('titre'),
            yield IntegerField::new('note'),
            yield TextField::new('contenu'),
            yield AssociationField::new('producteur')
                ->setLabel('Producteur')
                ->setRequired(true),
            yield AssociationField::new('redacteur')
            ->setLabel('Utilisateur')
            ->setRequired(true),
        ];
    }
}
