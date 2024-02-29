<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229063933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment_classroom (equipment_id INTEGER NOT NULL, classroom_id INTEGER NOT NULL, PRIMARY KEY(equipment_id, classroom_id), CONSTRAINT FK_9B4076E4517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B4076E46278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9B4076E4517FE9FE ON equipment_classroom (equipment_id)');
        $this->addSql('CREATE INDEX IDX_9B4076E46278D5A8 ON equipment_classroom (classroom_id)');
        $this->addSql('CREATE TABLE software_classroom (software_id INTEGER NOT NULL, classroom_id INTEGER NOT NULL, PRIMARY KEY(software_id, classroom_id), CONSTRAINT FK_453C7FA9D7452741 FOREIGN KEY (software_id) REFERENCES software (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_453C7FA96278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_453C7FA9D7452741 ON software_classroom (software_id)');
        $this->addSql('CREATE INDEX IDX_453C7FA96278D5A8 ON software_classroom (classroom_id)');
        $this->addSql('DROP TABLE classroom_equipment');
        $this->addSql('CREATE TEMPORARY TABLE __temp__software AS SELECT id, software_name, version, description, year, equipment_id FROM software');
        $this->addSql('DROP TABLE software');
        $this->addSql('CREATE TABLE software (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, software_name VARCHAR(255) NOT NULL, version VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, year INTEGER DEFAULT NULL, admin_id INTEGER DEFAULT NULL, CONSTRAINT FK_77D068CF642B8210 FOREIGN KEY (admin_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO software (id, software_name, version, description, year, admin_id) SELECT id, software_name, version, description, year, equipment_id FROM __temp__software');
        $this->addSql('DROP TABLE __temp__software');
        $this->addSql('CREATE INDEX IDX_77D068CF642B8210 ON software (admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom_equipment (classroom_id INTEGER NOT NULL, equipment_id INTEGER NOT NULL, PRIMARY KEY(classroom_id, equipment_id), CONSTRAINT FK_620603FE6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_620603FE517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_620603FE517FE9FE ON classroom_equipment (equipment_id)');
        $this->addSql('CREATE INDEX IDX_620603FE6278D5A8 ON classroom_equipment (classroom_id)');
        $this->addSql('DROP TABLE equipment_classroom');
        $this->addSql('DROP TABLE software_classroom');
        $this->addSql('CREATE TEMPORARY TABLE __temp__software AS SELECT id, software_name, version, description, year, admin_id FROM software');
        $this->addSql('DROP TABLE software');
        $this->addSql('CREATE TABLE software (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, software_name VARCHAR(255) NOT NULL, version VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, year INTEGER DEFAULT NULL, equipment_id INTEGER DEFAULT NULL, CONSTRAINT FK_77D068CF517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO software (id, software_name, version, description, year, equipment_id) SELECT id, software_name, version, description, year, admin_id FROM __temp__software');
        $this->addSql('DROP TABLE __temp__software');
        $this->addSql('CREATE INDEX IDX_77D068CF517FE9FE ON software (equipment_id)');
    }
}
