<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221200453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__equipment AS SELECT id, option, created_at, updated_at, admin_id FROM equipment');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('CREATE TABLE equipment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, option VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, admin_id INTEGER NOT NULL, CONSTRAINT FK_D338D583642B8210 FOREIGN KEY (admin_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO equipment (id, option, created_at, updated_at, admin_id) SELECT id, option, created_at, updated_at, admin_id FROM __temp__equipment');
        $this->addSql('DROP TABLE __temp__equipment');
        $this->addSql('CREATE INDEX IDX_D338D583642B8210 ON equipment (admin_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__software AS SELECT id, software_name, version, description, year FROM software');
        $this->addSql('DROP TABLE software');
        $this->addSql('CREATE TABLE software (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, software_name VARCHAR(255) NOT NULL, version VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, year INTEGER DEFAULT NULL, equipment_id INTEGER DEFAULT NULL, CONSTRAINT FK_77D068CF517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO software (id, software_name, version, description, year) SELECT id, software_name, version, description, year FROM __temp__software');
        $this->addSql('DROP TABLE __temp__software');
        $this->addSql('CREATE INDEX IDX_77D068CF517FE9FE ON software (equipment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__equipment AS SELECT id, option, created_at, updated_at, admin_id FROM equipment');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('CREATE TABLE equipment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, option BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, admin_id INTEGER NOT NULL, CONSTRAINT FK_D338D583642B8210 FOREIGN KEY (admin_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO equipment (id, option, created_at, updated_at, admin_id) SELECT id, option, created_at, updated_at, admin_id FROM __temp__equipment');
        $this->addSql('DROP TABLE __temp__equipment');
        $this->addSql('CREATE INDEX IDX_D338D583642B8210 ON equipment (admin_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__software AS SELECT id, software_name, version, description, year FROM software');
        $this->addSql('DROP TABLE software');
        $this->addSql('CREATE TABLE software (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, software_name VARCHAR(255) NOT NULL, version VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, year INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO software (id, software_name, version, description, year) SELECT id, software_name, version, description, year FROM __temp__software');
        $this->addSql('DROP TABLE __temp__software');
    }
}
