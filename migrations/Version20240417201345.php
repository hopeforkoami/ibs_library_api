<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417201345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ns_chapitre (id INT AUTO_INCREMENT NOT NULL, cours_ue_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, tags LONGTEXT DEFAULT NULL, display VARCHAR(255) DEFAULT NULL, INDEX IDX_30F0D3A2528E0A67 (cours_ue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_classe (id INT AUTO_INCREMENT NOT NULL, programme_id INT DEFAULT NULL, serie_id INT DEFAULT NULL, niveau_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, display_name VARCHAR(255) DEFAULT NULL, INDEX IDX_BBAF5F8062BB7AEE (programme_id), INDEX IDX_BBAF5F80D94388BD (serie_id), INDEX IDX_BBAF5F80B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_cours_ue (id INT AUTO_INCREMENT NOT NULL, matiere_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, tags LONGTEXT DEFAULT NULL, display_name VARCHAR(255) NOT NULL, INDEX IDX_532D76FCF46CD258 (matiere_id), INDEX IDX_532D76FC8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_ecole_periode (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_epreuve (id INT AUTO_INCREMENT NOT NULL, periode_id INT DEFAULT NULL, cours_id INT DEFAULT NULL, etablissement_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, date_composition DATE DEFAULT NULL, auteur VARCHAR(255) DEFAULT NULL, fichier VARCHAR(255) NOT NULL, contenu_text LONGTEXT DEFAULT NULL, contenu_html LONGTEXT DEFAULT NULL, INDEX IDX_224D79CEF384C1CF (periode_id), INDEX IDX_224D79CE7ECF78B0 (cours_id), INDEX IDX_224D79CEFF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_etablissement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, adresse LONGTEXT DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, site_web VARCHAR(255) DEFAULT NULL, gps VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_exercice (id INT AUTO_INCREMENT NOT NULL, epreuve_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, contenu_text LONGTEXT DEFAULT NULL, contenu_html LONGTEXT DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, INDEX IDX_588AA4CAAB990336 (epreuve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_matiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_niveau (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, nbre_annees INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_pays (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, alpha2 VARCHAR(2) NOT NULL, alpha3 VARCHAR(3) NOT NULL, nom_en_gb VARCHAR(50) NOT NULL, nom_fr_fr VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_programme (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_4EBC3D1FA6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_serie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, display_name VARCHAR(255) NOT NULL, tags VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ns_chapitre ADD CONSTRAINT FK_30F0D3A2528E0A67 FOREIGN KEY (cours_ue_id) REFERENCES ns_cours_ue (id)');
        $this->addSql('ALTER TABLE ns_classe ADD CONSTRAINT FK_BBAF5F8062BB7AEE FOREIGN KEY (programme_id) REFERENCES ns_programme (id)');
        $this->addSql('ALTER TABLE ns_classe ADD CONSTRAINT FK_BBAF5F80D94388BD FOREIGN KEY (serie_id) REFERENCES ns_serie (id)');
        $this->addSql('ALTER TABLE ns_classe ADD CONSTRAINT FK_BBAF5F80B3E9C81 FOREIGN KEY (niveau_id) REFERENCES ns_niveau (id)');
        $this->addSql('ALTER TABLE ns_cours_ue ADD CONSTRAINT FK_532D76FCF46CD258 FOREIGN KEY (matiere_id) REFERENCES ns_matiere (id)');
        $this->addSql('ALTER TABLE ns_cours_ue ADD CONSTRAINT FK_532D76FC8F5EA509 FOREIGN KEY (classe_id) REFERENCES ns_classe (id)');
        $this->addSql('ALTER TABLE ns_epreuve ADD CONSTRAINT FK_224D79CEF384C1CF FOREIGN KEY (periode_id) REFERENCES ns_ecole_periode (id)');
        $this->addSql('ALTER TABLE ns_epreuve ADD CONSTRAINT FK_224D79CE7ECF78B0 FOREIGN KEY (cours_id) REFERENCES ns_cours_ue (id)');
        $this->addSql('ALTER TABLE ns_epreuve ADD CONSTRAINT FK_224D79CEFF631228 FOREIGN KEY (etablissement_id) REFERENCES ns_etablissement (id)');
        $this->addSql('ALTER TABLE ns_exercice ADD CONSTRAINT FK_588AA4CAAB990336 FOREIGN KEY (epreuve_id) REFERENCES ns_epreuve (id)');
        $this->addSql('ALTER TABLE ns_programme ADD CONSTRAINT FK_4EBC3D1FA6E44244 FOREIGN KEY (pays_id) REFERENCES ns_pays (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ns_chapitre DROP FOREIGN KEY FK_30F0D3A2528E0A67');
        $this->addSql('ALTER TABLE ns_classe DROP FOREIGN KEY FK_BBAF5F8062BB7AEE');
        $this->addSql('ALTER TABLE ns_classe DROP FOREIGN KEY FK_BBAF5F80D94388BD');
        $this->addSql('ALTER TABLE ns_classe DROP FOREIGN KEY FK_BBAF5F80B3E9C81');
        $this->addSql('ALTER TABLE ns_cours_ue DROP FOREIGN KEY FK_532D76FCF46CD258');
        $this->addSql('ALTER TABLE ns_cours_ue DROP FOREIGN KEY FK_532D76FC8F5EA509');
        $this->addSql('ALTER TABLE ns_epreuve DROP FOREIGN KEY FK_224D79CEF384C1CF');
        $this->addSql('ALTER TABLE ns_epreuve DROP FOREIGN KEY FK_224D79CE7ECF78B0');
        $this->addSql('ALTER TABLE ns_epreuve DROP FOREIGN KEY FK_224D79CEFF631228');
        $this->addSql('ALTER TABLE ns_exercice DROP FOREIGN KEY FK_588AA4CAAB990336');
        $this->addSql('ALTER TABLE ns_programme DROP FOREIGN KEY FK_4EBC3D1FA6E44244');
        $this->addSql('DROP TABLE ns_chapitre');
        $this->addSql('DROP TABLE ns_classe');
        $this->addSql('DROP TABLE ns_cours_ue');
        $this->addSql('DROP TABLE ns_ecole_periode');
        $this->addSql('DROP TABLE ns_epreuve');
        $this->addSql('DROP TABLE ns_etablissement');
        $this->addSql('DROP TABLE ns_exercice');
        $this->addSql('DROP TABLE ns_matiere');
        $this->addSql('DROP TABLE ns_niveau');
        $this->addSql('DROP TABLE ns_pays');
        $this->addSql('DROP TABLE ns_programme');
        $this->addSql('DROP TABLE ns_serie');
    }
}
