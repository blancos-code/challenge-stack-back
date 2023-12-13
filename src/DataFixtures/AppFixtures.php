<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Marche;
use App\Entity\Producteur;
use App\Entity\Produit;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $this->createUsers($faker, $manager);
        $manager->flush();

        $this->createCategories($faker, $manager);
        $manager->flush();

        $this->createMarches($faker, $manager);
        $manager->flush();

        $this->createProduits($faker, $manager);
        $manager->flush();

        $this->createProducteurs($faker, $manager);
        $manager->flush();
    }
    public function createUsers(\Faker\Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setPrenom($faker->firstName);
            $user->setNom($faker->lastName);
            $user->setEmail($faker->email);
            $user->setTel($faker->phoneNumber);
            $user->setAdresse($faker->address);
            $manager->persist($user);
        }
    }

    /**
     * @param \Faker\Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    public function createCategories(\Faker\Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($faker->word);
            $manager->persist($categorie);
        }
    }

    /**
     * @param \Faker\Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    public function createMarches(\Faker\Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $marche = new Marche();
            $marche->setNom($faker->word);
            $marche->setAdresse($faker->address);
            $marche->setDateDebut(new DateTimeImmutable($faker->dateTime->format('Y-m-d H:i:s')));
            $marche->setDateFin(new DateTimeImmutable($faker->dateTime->format('Y-m-d H:i:s')));
            $marche->setProprietaire($faker->randomElement($manager->getRepository(User::class)->findAll()));
            $manager->persist($marche);
        }
    }

    /**
     * @param \Faker\Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    public function createProducteurs(\Faker\Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $producteur = new Producteur();
            $producteur->setPrenom($faker->firstName);
            $producteur->setNom($faker->lastName);
            $producteur->setEmail($faker->email);
            $producteur->setTel($faker->phoneNumber);
            $producteur->setAdresse($faker->address);
            $producteur->setDescription($faker->text);
            $producteur->addMarche($faker->randomElement($manager->getRepository(Marche::class)->findAll()));
            $producteur->addProduit($faker->randomElement($manager->getRepository(Produit::class)->findAll()));
            $producteur->addProduit($faker->randomElement($manager->getRepository(Produit::class)->findAll()));
            $producteur->addProduit($faker->randomElement($manager->getRepository(Produit::class)->findAll()));

            $manager->persist($producteur);
        }
    }

    /**
     * @param \Faker\Generator $faker
     * @return void
     */
    public function createProduits(\Faker\Generator $faker, ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $produit = new Produit();
            $produit->setNom($faker->word);
            $produit->setPrix($faker->randomFloat(2, 0, 100));
            $manager->persist($produit);
        }
    }
}
