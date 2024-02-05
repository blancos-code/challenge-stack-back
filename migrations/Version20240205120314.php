<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205120314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_producteur (id INT AUTO_INCREMENT NOT NULL, producteur_id INT DEFAULT NULL, redacteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, note INT NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_C6E9DC90AB9BB300 (producteur_id), INDEX IDX_C6E9DC90764D0490 (redacteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_producteur ADD CONSTRAINT FK_C6E9DC90AB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
        $this->addSql('ALTER TABLE commentaire_producteur ADD CONSTRAINT FK_C6E9DC90764D0490 FOREIGN KEY (redacteur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_producteur DROP FOREIGN KEY FK_C6E9DC90AB9BB300');
        $this->addSql('ALTER TABLE commentaire_producteur DROP FOREIGN KEY FK_C6E9DC90764D0490');
        $this->addSql('DROP TABLE commentaire_producteur');
    }
}
