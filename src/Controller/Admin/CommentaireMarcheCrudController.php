<?php

namespace App\Controller\Admin;

use App\Entity\CommentaireMarche;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentaireMarcheCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return CommentaireMarche::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            yield TextField::new('titre'),
            yield IntegerField::new('note'),
            yield TextField::new('contenu'),
            yield AssociationField::new('marche')
                ->setLabel('Marche')
                ->setRequired(true),
            yield AssociationField::new('redacteur')
            ->setLabel('Utilisateur')
            ->setRequired(true),
        ];
    }
}
