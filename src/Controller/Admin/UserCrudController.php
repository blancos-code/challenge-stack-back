<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->hideOnForm(),
            yield BooleanField::new('isbanned')->setLabel('Banni')->setRequired(false),
            yield TextField::new('nom')->setLabel('Nom')->setRequired(true),
            yield TextField::new('prenom')->setLabel('Prénom')->setRequired(true),
            yield TextField::new('email')->setLabel('Email')->setRequired(true),
            yield TextField::new('tel')->setLabel('Téléphone')->setRequired(false),
            yield TextField::new('adresse')->setLabel('Adresse')->setRequired(true),
            yield Field::new('imageFile', 'Image')
            ->setFormType(VichImageType::class),
            yield AssociationField::new('commentaireMarches')
                ->setLabel('Commentaires (marchés)')
                ->setRequired(false)
                ->onlyOnForms(),
            yield AssociationField::new('commentaireProducteurs')
                ->setLabel('Commentaires (producteurs)')
                ->setRequired(false)
                ->onlyOnForms(),
        ];
    }
}
