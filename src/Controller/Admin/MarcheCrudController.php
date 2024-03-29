<?php

namespace App\Controller\Admin;

use App\Entity\Marche;
use App\Entity\Producteur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class MarcheCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Marche::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('Nom'),
            yield TextField::new('Adresse'),
            yield DateField::new('dateDebut')->setLabel('Date de début'),
            yield DateField::new('dateFin')->setLabel('Date de fin'),
            yield AssociationField::new('proprietaire')
            ->setLabel('Propriétaire')
            ->setRequired(true),
            yield AssociationField::new('producteurs')
            ->setLabel('Producteurs')
            ->setRequired(false),
            yield AssociationField::new('categorie')
            ->setLabel('Catégorie')
            ->setRequired(true),
            yield AssociationField::new('commentaireMarches')
            ->setLabel('Commentaires')
            ->setRequired(false),
        ];
    }
}
