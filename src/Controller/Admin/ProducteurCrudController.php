<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\Producteur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProducteurCrudController extends AbstractCrudController
{

    private $entityManager;
    
    public static function getEntityFqcn(): string
    {
        return Producteur::class;
    }
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('utilisateur', 'Utilisateur'),
            CollectionField::new('produits', 'Produit')
            ->setFormTypeOptions([
                'by_reference' => false, // Nécessaire pour manipuler la collection
                'delete_empty' => true, // Supprimer les éléments vides (non utilisés)
                'allow_delete' => false, // Désactiver la suppression d'éléments
                'allow_add' => false,
                'entry_options' => [
                    'disabled' => true, // Désactiver l'édition des éléments
                ],
            ]),
            TextEditorField::new('description'),
        ];
    }
    
}
