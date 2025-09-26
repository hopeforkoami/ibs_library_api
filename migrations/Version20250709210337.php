<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250709210337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, exemplaire_id INT DEFAULT NULL, membre_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_8933C4325843AA21 (exemplaire_id), INDEX IDX_8933C4326A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4325843AA21 FOREIGN KEY (exemplaire_id) REFERENCES exemplaire_livre (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4326A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('DROP TABLE 15___dification');
        $this->addSql('DROP TABLE 31_f__tes_chr__tiennes3');
        $this->addSql('DROP TABLE temp_categories');
        $this->addSql('DROP TABLE temp_table');
        $this->addSql('ALTER TABLE langue CHANGE code code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livre CHANGE langue_id_id langue_id_id INT NOT NULL, CHANGE nbre_pages nbre_pages INT NOT NULL, CHANGE nbre_exemplaires nbre_exemplaires INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9975F8742E FOREIGN KEY (auteur_id_id) REFERENCES auteur (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99497B596E FOREIGN KEY (langue_id_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99464D3EEB FOREIGN KEY (sous_categorie_id_id) REFERENCES sous_categorie (id)');
        $this->addSql('ALTER TABLE reservation_exemplaire_livre DROP FOREIGN KEY FK_3E52F5265843AA21');
        $this->addSql('ALTER TABLE reservation_exemplaire_livre DROP FOREIGN KEY FK_3E52F526B83297E7');
        $this->addSql('DROP INDEX idx_3e52f526b83297e7 ON reservation_exemplaire_livre');
        $this->addSql('CREATE INDEX IDX_388B95B0B83297E7 ON reservation_exemplaire_livre (reservation_id)');
        $this->addSql('DROP INDEX idx_3e52f5265843aa21 ON reservation_exemplaire_livre');
        $this->addSql('CREATE INDEX IDX_388B95B04E0D5118 ON reservation_exemplaire_livre (exemplaire_livre_id)');
        $this->addSql('ALTER TABLE reservation_exemplaire_livre ADD CONSTRAINT FK_3E52F5265843AA21 FOREIGN KEY (exemplaire_livre_id) REFERENCES exemplaire_livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_exemplaire_livre ADD CONSTRAINT FK_3E52F526B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_categorie CHANGE code code VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE 15___dification (title VARCHAR(80) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, book_url VARCHAR(155) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE 31_f__tes_chr__tiennes3 (Titre VARCHAR(28) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Lien VARCHAR(77) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE temp_categories (title VARCHAR(47) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, book_url VARCHAR(111) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE temp_table (title VARCHAR(52) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, author VARCHAR(18) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, image_url VARCHAR(154) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, description VARCHAR(18342) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, price VARCHAR(3) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, isbn VARCHAR(13) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, publisher VARCHAR(21) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, publication_date VARCHAR(19) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, format VARCHAR(26) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, pages VARCHAR(19) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, language VARCHAR(3) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, book_url VARCHAR(129) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, original_title VARCHAR(72) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, id_souscategorie INT DEFAULT 1 NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4325843AA21');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4326A99F74A');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('ALTER TABLE langue CHANGE code code VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9975F8742E');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99497B596E');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99464D3EEB');
        $this->addSql('ALTER TABLE livre CHANGE langue_id_id langue_id_id INT DEFAULT 1 NOT NULL, CHANGE nbre_pages nbre_pages INT DEFAULT 0 NOT NULL, CHANGE nbre_exemplaires nbre_exemplaires INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE reservation_exemplaire_livre DROP FOREIGN KEY FK_388B95B0B83297E7');
        $this->addSql('ALTER TABLE reservation_exemplaire_livre DROP FOREIGN KEY FK_388B95B04E0D5118');
        $this->addSql('DROP INDEX idx_388b95b04e0d5118 ON reservation_exemplaire_livre');
        $this->addSql('CREATE INDEX IDX_3E52F5265843AA21 ON reservation_exemplaire_livre (exemplaire_livre_id)');
        $this->addSql('DROP INDEX idx_388b95b0b83297e7 ON reservation_exemplaire_livre');
        $this->addSql('CREATE INDEX IDX_3E52F526B83297E7 ON reservation_exemplaire_livre (reservation_id)');
        $this->addSql('ALTER TABLE reservation_exemplaire_livre ADD CONSTRAINT FK_388B95B0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_exemplaire_livre ADD CONSTRAINT FK_388B95B04E0D5118 FOREIGN KEY (exemplaire_livre_id) REFERENCES exemplaire_livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_categorie CHANGE code code VARCHAR(255) DEFAULT NULL');
    }
}
