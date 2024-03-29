<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Marche;
use App\Entity\PrixProduits;
use App\Entity\Producteur;
use App\Entity\Produit;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $this->createUsers($faker, $manager);
        $manager->flush();

        $this->createProducteurs($faker, $manager);
        $manager->flush();

        $this->createCategories($faker, $manager);
        $manager->flush();

        $this->createMarches($faker, $manager);
        $manager->flush();

        $this->createProduits($faker, $manager);
        $manager->flush();

        $this->createPrixProduit($faker, $manager);
        $manager->flush();
    }

    public function createUsers(Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setPrenom($faker->firstName);
            $user->setNom($faker->lastName);
            $user->setEmail($faker->email);
            $user->setTel($faker->phoneNumber);
            $user->setAdresse($faker->address);
            $user->setIsBanned(false);
            $manager->persist($user);
        }
    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    public function createCategories(Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($faker->word);
            $manager->persist($categorie);
        }
    }


    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    public function createProducteurs(Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 1; $i++) {
            $producteur = new Producteur();
            $producteur->setDescription($faker->text);
            // $producteur->addMarche($faker->randomElement($manager->getRepository(Marche::class)->findAll()));
            $producteur->setUtilisateur($faker->randomElement($manager->getRepository(User::class)->findAll()));
            
            $manager->persist($producteur);
        }
    }


    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    public function createMarches(Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $marche = new Marche();
            $marche->setNom($faker->word);
            $marche->setAdresse($faker->address);
            $marche->setDateDebut(new DateTimeImmutable($faker->dateTime->format('Y-m-d H:i:s')));
            $marche->setDateFin(new DateTimeImmutable($faker->dateTime->format('Y-m-d H:i:s')));
            $marche->setProprietaire($faker->randomElement($manager->getRepository(User::class)->findAll()));
            $marche->setCategorie($faker->randomElement($manager->getRepository(Categorie::class)->findAll()));
            $manager->persist($marche);
        }
    }


    /**
     * @param Generator $faker
     * @return void
     */
    public function createProduits(Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $produit = new Produit();
            $produit->setNom($faker->word);
            $manager->persist($produit);
        }
    }

    public function createPrixProduit(Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $prixProduit = new PrixProduits();
            $produit = $faker->randomElement($manager->getRepository(Produit::class)->findAll());
            $producteur = $faker->randomElement($manager->getRepository(Producteur::class)->findAll());

            $prixProduit->setProduit($produit);
            $prixProduit->setProducteur($producteur);
            $prixProduit->setPrix($faker->randomDigitNotZero());
            $manager->persist($prixProduit);
        }
    }
}
