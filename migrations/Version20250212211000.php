<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250212211000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exemplaire_livre (id INT AUTO_INCREMENT NOT NULL, livre_id INT DEFAULT NULL, position_id INT DEFAULT NULL, numero INT NOT NULL, libre TINYINT(1) NOT NULL, date_disponible DATE NOT NULL, INDEX IDX_37D47C3837D925CB (livre_id), INDEX IDX_37D47C38DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exemplaire_livre ADD CONSTRAINT FK_37D47C3837D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE exemplaire_livre ADD CONSTRAINT FK_37D47C38DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exemplaire_livre DROP FOREIGN KEY FK_37D47C3837D925CB');
        $this->addSql('ALTER TABLE exemplaire_livre DROP FOREIGN KEY FK_37D47C38DD842E46');
        $this->addSql('DROP TABLE exemplaire_livre');
    }
}
