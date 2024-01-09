<?php

namespace App\Controller\Admin;

use App\Entity\Producteur;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProducteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Producteur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('utilisateur', 'Utilisateur'),
            AssociationField::new('produits', 'Produit'),
            TextEditorField::new('description'),
        ];
    }
    
}
