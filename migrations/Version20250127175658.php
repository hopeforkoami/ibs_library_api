<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127175658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom_complet VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, nbre_livres INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, livre_id_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, tags LONGTEXT DEFAULT NULL, INDEX IDX_8C62B025EC470631 (livre_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emplacement (id INT AUTO_INCREMENT NOT NULL, ranger VARCHAR(255) NOT NULL, colonne VARCHAR(255) NOT NULL, position INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, status_emprunt_id_id INT DEFAULT NULL, exemplaire_id INT DEFAULT NULL, date_debut_emprunt DATETIME NOT NULL, date_fin_emprunt_prevu DATETIME NOT NULL, date_fin_emprunt DATETIME DEFAULT NULL, date_prevu_rappel DATETIME NOT NULL, INDEX IDX_364071D7B83297E7 (reservation_id), INDEX IDX_364071D7A8CF07A9 (status_emprunt_id_id), INDEX IDX_364071D75843AA21 (exemplaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exemplaire (id INT AUTO_INCREMENT NOT NULL, livre_id_id INT DEFAULT NULL, emplacement_id_id INT DEFAULT NULL, numero INT NOT NULL, libre TINYINT(1) NOT NULL, date_disponible DATE DEFAULT NULL, INDEX IDX_5EF83C92EC470631 (livre_id_id), UNIQUE INDEX UNIQ_5EF83C92D8E418E2 (emplacement_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, auteur_id_id INT NOT NULL, langue_id_id INT NOT NULL, sous_categorie_id_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, nbre_pages INT NOT NULL, nbre_exemplaires INT NOT NULL, image VARCHAR(255) DEFAULT NULL, tags LONGTEXT DEFAULT NULL, themes LONGTEXT DEFAULT NULL, resume LONGTEXT DEFAULT NULL, edition VARCHAR(255) NOT NULL, INDEX IDX_AC634F9975F8742E (auteur_id_id), INDEX IDX_AC634F99497B596E (langue_id_id), INDEX IDX_AC634F99464D3EEB (sous_categorie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, role_id_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password LONGTEXT NOT NULL, contact VARCHAR(50) NOT NULL, whatsapp VARCHAR(50) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, profil LONGTEXT NOT NULL, INDEX IDX_F6B4FB2988987678 (role_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ns_authorisation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_C1D06362A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, status_reservation_id INT DEFAULT NULL, date_debut_prevu DATETIME NOT NULL, date_fin_prevu DATETIME NOT NULL, date_reservation DATETIME NOT NULL, INDEX IDX_42C849556A99F74A (membre_id), INDEX IDX_42C84955387A387D (status_reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_exemplaire (reservation_id INT NOT NULL, exemplaire_id INT NOT NULL, INDEX IDX_3E52F526B83297E7 (reservation_id), INDEX IDX_3E52F5265843AA21 (exemplaire_id), PRIMARY KEY(reservation_id, exemplaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_livre (reservation_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_EF1C9F3EB83297E7 (reservation_id), INDEX IDX_EF1C9F3E37D925CB (livre_id), PRIMARY KEY(reservation_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, parent_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_emprunt (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_reservation (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, couleur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B025EC470631 FOREIGN KEY (livre_id_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7A8CF07A9 FOREIGN KEY (status_emprunt_id_id) REFERENCES status_emprunt (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D75843AA21 FOREIGN KEY (exemplaire_id) REFERENCES exemplaire (id)');
        $this->addSql('ALTER TABLE exemplaire ADD CONSTRAINT FK_5EF83C92EC470631 FOREIGN KEY (livre_id_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE exemplaire ADD CONSTRAINT FK_5EF83C92D8E418E2 FOREIGN KEY (emplacement_id_id) REFERENCES emplacement (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9975F8742E FOREIGN KEY (auteur_id_id) REFERENCES auteur (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99497B596E FOREIGN KEY (langue_id_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99464D3EEB FOREIGN KEY (sous_categorie_id_id) REFERENCES sous_categorie (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2988987678 FOREIGN KEY (role_id_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE ns_authorisation ADD CONSTRAINT FK_C1D06362A76ED395 FOREIGN KEY (user_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955387A387D FOREIGN KEY (status_reservation_id) REFERENCES status_reservation (id)');
        $this->addSql('ALTER TABLE reservation_exemplaire ADD CONSTRAINT FK_3E52F526B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_exemplaire ADD CONSTRAINT FK_3E52F5265843AA21 FOREIGN KEY (exemplaire_id) REFERENCES exemplaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_livre ADD CONSTRAINT FK_EF1C9F3EB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_livre ADD CONSTRAINT FK_EF1C9F3E37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE livres');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livres (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, auteur VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, image_url VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, description TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, price VARCHAR(10) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, availability VARCHAR(12) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, publisher VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, ean VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, reference VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, book_url VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B025EC470631');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7B83297E7');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7A8CF07A9');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D75843AA21');
        $this->addSql('ALTER TABLE exemplaire DROP FOREIGN KEY FK_5EF83C92EC470631');
        $this->addSql('ALTER TABLE exemplaire DROP FOREIGN KEY FK_5EF83C92D8E418E2');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9975F8742E');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99497B596E');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99464D3EEB');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB2988987678');
        $this->addSql('ALTER TABLE ns_authorisation DROP FOREIGN KEY FK_C1D06362A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556A99F74A');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955387A387D');
        $this->addSql('ALTER TABLE reservation_exemplaire DROP FOREIGN KEY FK_3E52F526B83297E7');
        $this->addSql('ALTER TABLE reservation_exemplaire DROP FOREIGN KEY FK_3E52F5265843AA21');
        $this->addSql('ALTER TABLE reservation_livre DROP FOREIGN KEY FK_EF1C9F3EB83297E7');
        $this->addSql('ALTER TABLE reservation_livre DROP FOREIGN KEY FK_EF1C9F3E37D925CB');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE emplacement');
        $this->addSql('DROP TABLE emprunt');
        $this->addSql('DROP TABLE exemplaire');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE ns_authorisation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_exemplaire');
        $this->addSql('DROP TABLE reservation_livre');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE status_emprunt');
        $this->addSql('DROP TABLE status_reservation');
    }
}
