<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110155550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_produits ADD producteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prix_produits ADD CONSTRAINT FK_C512C6FEAB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
        $this->addSql('CREATE INDEX IDX_C512C6FEAB9BB300 ON prix_produits (producteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_produits DROP FOREIGN KEY FK_C512C6FEAB9BB300');
        $this->addSql('DROP INDEX IDX_C512C6FEAB9BB300 ON prix_produits');
        $this->addSql('ALTER TABLE prix_produits DROP producteur_id');
    }
}
