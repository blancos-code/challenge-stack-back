<?php

namespace App\Form;

use App\Entity\PrixProduits;
use App\Entity\Producteur;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix')
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PrixProduits::class,
        ]);
    }
}
