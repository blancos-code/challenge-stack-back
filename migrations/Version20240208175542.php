<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208175542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_marche (id INT AUTO_INCREMENT NOT NULL, marche_id INT DEFAULT NULL, redacteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, note INT NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_AE255A4B9E494911 (marche_id), INDEX IDX_AE255A4B764D0490 (redacteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_producteur (id INT AUTO_INCREMENT NOT NULL, producteur_id INT DEFAULT NULL, redacteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, note INT NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_C6E9DC90AB9BB300 (producteur_id), INDEX IDX_C6E9DC90764D0490 (redacteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marche (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, categorie_id INT DEFAULT NULL, adresse VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_fin DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', nom VARCHAR(255) NOT NULL, INDEX IDX_BAA18ACC76C50E4A (proprietaire_id), INDEX IDX_BAA18ACCBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marche_producteur (marche_id INT NOT NULL, producteur_id INT NOT NULL, INDEX IDX_F3ED65D79E494911 (marche_id), INDEX IDX_F3ED65D7AB9BB300 (producteur_id), PRIMARY KEY(marche_id, producteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marche_user (marche_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B82784B29E494911 (marche_id), INDEX IDX_B82784B2A76ED395 (user_id), PRIMARY KEY(marche_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix_produits (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, producteur_id INT DEFAULT NULL, prix NUMERIC(10, 2) NOT NULL, INDEX IDX_C512C6FEF347EFB (produit_id), INDEX IDX_C512C6FEAB9BB300 (producteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producteur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, description LONGTEXT NOT NULL, note DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_7EDBEE10FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, is_banned TINYINT(1) NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_marche (user_id INT NOT NULL, marche_id INT NOT NULL, INDEX IDX_DFF391F1A76ED395 (user_id), INDEX IDX_DFF391F19E494911 (marche_id), PRIMARY KEY(user_id, marche_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_marche ADD CONSTRAINT FK_AE255A4B9E494911 FOREIGN KEY (marche_id) REFERENCES marche (id)');
        $this->addSql('ALTER TABLE commentaire_marche ADD CONSTRAINT FK_AE255A4B764D0490 FOREIGN KEY (redacteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire_producteur ADD CONSTRAINT FK_C6E9DC90AB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
        $this->addSql('ALTER TABLE commentaire_producteur ADD CONSTRAINT FK_C6E9DC90764D0490 FOREIGN KEY (redacteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE marche ADD CONSTRAINT FK_BAA18ACC76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE marche ADD CONSTRAINT FK_BAA18ACCBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE marche_producteur ADD CONSTRAINT FK_F3ED65D79E494911 FOREIGN KEY (marche_id) REFERENCES marche (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marche_producteur ADD CONSTRAINT FK_F3ED65D7AB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marche_user ADD CONSTRAINT FK_B82784B29E494911 FOREIGN KEY (marche_id) REFERENCES marche (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marche_user ADD CONSTRAINT FK_B82784B2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_produits ADD CONSTRAINT FK_C512C6FEF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE prix_produits ADD CONSTRAINT FK_C512C6FEAB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
        $this->addSql('ALTER TABLE producteur ADD CONSTRAINT FK_7EDBEE10FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_marche ADD CONSTRAINT FK_DFF391F1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_marche ADD CONSTRAINT FK_DFF391F19E494911 FOREIGN KEY (marche_id) REFERENCES marche (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_marche DROP FOREIGN KEY FK_AE255A4B9E494911');
        $this->addSql('ALTER TABLE commentaire_marche DROP FOREIGN KEY FK_AE255A4B764D0490');
        $this->addSql('ALTER TABLE commentaire_producteur DROP FOREIGN KEY FK_C6E9DC90AB9BB300');
        $this->addSql('ALTER TABLE commentaire_producteur DROP FOREIGN KEY FK_C6E9DC90764D0490');
        $this->addSql('ALTER TABLE marche DROP FOREIGN KEY FK_BAA18ACC76C50E4A');
        $this->addSql('ALTER TABLE marche DROP FOREIGN KEY FK_BAA18ACCBCF5E72D');
        $this->addSql('ALTER TABLE marche_producteur DROP FOREIGN KEY FK_F3ED65D79E494911');
        $this->addSql('ALTER TABLE marche_producteur DROP FOREIGN KEY FK_F3ED65D7AB9BB300');
        $this->addSql('ALTER TABLE marche_user DROP FOREIGN KEY FK_B82784B29E494911');
        $this->addSql('ALTER TABLE marche_user DROP FOREIGN KEY FK_B82784B2A76ED395');
        $this->addSql('ALTER TABLE prix_produits DROP FOREIGN KEY FK_C512C6FEF347EFB');
        $this->addSql('ALTER TABLE prix_produits DROP FOREIGN KEY FK_C512C6FEAB9BB300');
        $this->addSql('ALTER TABLE producteur DROP FOREIGN KEY FK_7EDBEE10FB88E14F');
        $this->addSql('ALTER TABLE user_marche DROP FOREIGN KEY FK_DFF391F1A76ED395');
        $this->addSql('ALTER TABLE user_marche DROP FOREIGN KEY FK_DFF391F19E494911');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire_marche');
        $this->addSql('DROP TABLE commentaire_producteur');
        $this->addSql('DROP TABLE marche');
        $this->addSql('DROP TABLE marche_producteur');
        $this->addSql('DROP TABLE marche_user');
        $this->addSql('DROP TABLE prix_produits');
        $this->addSql('DROP TABLE producteur');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_marche');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
