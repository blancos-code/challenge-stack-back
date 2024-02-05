<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205100639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_marche (id INT AUTO_INCREMENT NOT NULL, marche_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, note INT NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_AE255A4B9E494911 (marche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_marche ADD CONSTRAINT FK_AE255A4B9E494911 FOREIGN KEY (marche_id) REFERENCES marche (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_marche DROP FOREIGN KEY FK_AE255A4B9E494911');
        $this->addSql('DROP TABLE commentaire_marche');
    }
}
