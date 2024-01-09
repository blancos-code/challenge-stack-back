<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109080817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producteur DROP FOREIGN KEY FK_7EDBEE10A76ED395');
        $this->addSql('DROP INDEX IDX_7EDBEE10A76ED395 ON producteur');
        $this->addSql('ALTER TABLE producteur ADD utilisateur_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE producteur ADD CONSTRAINT FK_7EDBEE10FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7EDBEE10FB88E14F ON producteur (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producteur DROP FOREIGN KEY FK_7EDBEE10FB88E14F');
        $this->addSql('DROP INDEX UNIQ_7EDBEE10FB88E14F ON producteur');
        $this->addSql('ALTER TABLE producteur ADD user_id INT NOT NULL, DROP utilisateur_id');
        $this->addSql('ALTER TABLE producteur ADD CONSTRAINT FK_7EDBEE10A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7EDBEE10A76ED395 ON producteur (user_id)');
    }
}
