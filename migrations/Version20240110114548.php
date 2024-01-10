<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110114548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prix_produits (id INT AUTO_INCREMENT NOT NULL, producteur_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, prix NUMERIC(10, 2) NOT NULL, INDEX IDX_C512C6FEAB9BB300 (producteur_id), INDEX IDX_C512C6FEF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prix_produits ADD CONSTRAINT FK_C512C6FEAB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
        $this->addSql('ALTER TABLE prix_produits ADD CONSTRAINT FK_C512C6FEF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27AB9BB300');
        $this->addSql('DROP INDEX IDX_29A5EC27AB9BB300 ON produit');
        $this->addSql('ALTER TABLE produit DROP producteur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_produits DROP FOREIGN KEY FK_C512C6FEAB9BB300');
        $this->addSql('ALTER TABLE prix_produits DROP FOREIGN KEY FK_C512C6FEF347EFB');
        $this->addSql('DROP TABLE prix_produits');
        $this->addSql('ALTER TABLE produit ADD producteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27AB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29A5EC27AB9BB300 ON produit (producteur_id)');
    }
}
