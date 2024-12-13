<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417202323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ns_authorisation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_C1D06362A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_droit (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_user (id INT AUTO_INCREMENT NOT NULL, droit_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_DDC7C6E65AA93370 (droit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ns_authorisation ADD CONSTRAINT FK_C1D06362A76ED395 FOREIGN KEY (user_id) REFERENCES ns_user (id)');
        $this->addSql('ALTER TABLE ns_user ADD CONSTRAINT FK_DDC7C6E65AA93370 FOREIGN KEY (droit_id) REFERENCES ns_droit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ns_authorisation DROP FOREIGN KEY FK_C1D06362A76ED395');
        $this->addSql('ALTER TABLE ns_user DROP FOREIGN KEY FK_DDC7C6E65AA93370');
        $this->addSql('DROP TABLE ns_authorisation');
        $this->addSql('DROP TABLE ns_droit');
        $this->addSql('DROP TABLE ns_user');
    }
}
