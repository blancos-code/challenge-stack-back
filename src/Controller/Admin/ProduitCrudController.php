<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\Producteur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitCrudController extends AbstractCrudController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    private function getProprietairesChoices(): array
    {
        $proprietaires = $this->entityManager->getRepository(Producteur::class)->findAll();

        $choices = [];
        foreach ($proprietaires as $proprietaire) {
            $choices[$proprietaire->getId()] = $proprietaire->getNomComplet();
        }

        return $choices;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            NumberField::new('prix')->setFormTypeOptions(['scale' => 2]),
            AssociationField::new('producteur', 'Producteur'),
        ];
    }
}
