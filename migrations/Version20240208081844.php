<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208081844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marche DROP FOREIGN KEY FK_BAA18ACC76C50E4A');
        $this->addSql('ALTER TABLE marche DROP description, DROP note');
        $this->addSql('ALTER TABLE marche ADD CONSTRAINT FK_BAA18ACC76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD image_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP image_name');
        $this->addSql('ALTER TABLE marche DROP FOREIGN KEY FK_BAA18ACC76C50E4A');
        $this->addSql('ALTER TABLE marche ADD description VARCHAR(255) DEFAULT NULL, ADD note DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE marche ADD CONSTRAINT FK_BAA18ACC76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES producteur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
