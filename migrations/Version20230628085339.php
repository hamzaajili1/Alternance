<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628085339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pointages (id INT AUTO_INCREMENT NOT NULL, utilisateur VARCHAR(50) NOT NULL, chantier VARCHAR(255) NOT NULL, date DATE NOT NULL, duree VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateurs ADD chantiers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E691F92D8 FOREIGN KEY (chantiers_id) REFERENCES chantiers (id)');
        $this->addSql('CREATE INDEX IDX_497B315E691F92D8 ON utilisateurs (chantiers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pointages');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E691F92D8');
        $this->addSql('DROP INDEX IDX_497B315E691F92D8 ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs DROP chantiers_id');
    }
}
