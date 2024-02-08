<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205103333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_marche ADD redacteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire_marche ADD CONSTRAINT FK_AE255A4B764D0490 FOREIGN KEY (redacteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AE255A4B764D0490 ON commentaire_marche (redacteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_marche DROP FOREIGN KEY FK_AE255A4B764D0490');
        $this->addSql('DROP INDEX IDX_AE255A4B764D0490 ON commentaire_marche');
        $this->addSql('ALTER TABLE commentaire_marche DROP redacteur_id');
    }
}
