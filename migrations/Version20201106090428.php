<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201106090428 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE besoin (id INT AUTO_INCREMENT NOT NULL, structure_id INT DEFAULT NULL, description LONGTEXT NOT NULL, priorite VARCHAR(255) NOT NULL, cadre INT NOT NULL, agent INT NOT NULL, employer INT NOT NULL, observation LONGTEXT DEFAULT NULL, INDEX IDX_8118E8112534008B (structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, secteur_activite_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, membre VARCHAR(255) NOT NULL, cfce VARCHAR(255) NOT NULL, prenom_nom_referent VARCHAR(255) NOT NULL, fonction_referent VARCHAR(255) NOT NULL, telephone INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_6F0137EA5233A7FC (secteur_activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE besoin ADD CONSTRAINT FK_8118E8112534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA5233A7FC FOREIGN KEY (secteur_activite_id) REFERENCES activite (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA5233A7FC');
        $this->addSql('ALTER TABLE besoin DROP FOREIGN KEY FK_8118E8112534008B');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE besoin');
        $this->addSql('DROP TABLE structure');
    }
}
