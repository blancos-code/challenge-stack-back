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

class MarcheCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public static function getEntityFqcn(): string
    {
        return Marche::class;
    }

    private function getProprietairesChoices(): array
    {
        // Récupérer la liste des propriétaires depuis la base de données
        $proprietaires = $this->entityManager->getRepository(Producteur::class)->findAll();

        // Générer un tableau associatif pour les choix
        $choices = [];
        foreach ($proprietaires as $proprietaire) {
            $choices[$proprietaire->getId()] = $proprietaire->getNomComplet(); // Assurez-vous d'ajuster cela en fonction de votre logique
        }

        return $choices;
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
            ChoiceField::new('producteurs')
                ->setLabel('Producteurs')
                ->setFormTypeOptions([
                    'choices' => $this->getProprietairesChoices(),
                    'multiple' => true,
                    'expanded' => false,
                ]),
        
        ];
    }
    
}
