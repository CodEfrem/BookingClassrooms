<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216135619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment_software (equipment_id INTEGER NOT NULL, software_id INTEGER NOT NULL, PRIMARY KEY(equipment_id, software_id), CONSTRAINT FK_4713ECE9517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4713ECE9D7452741 FOREIGN KEY (software_id) REFERENCES software (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_4713ECE9517FE9FE ON equipment_software (equipment_id)');
        $this->addSql('CREATE INDEX IDX_4713ECE9D7452741 ON equipment_software (software_id)');
        $this->addSql('CREATE TABLE software (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, software_name VARCHAR(255) NOT NULL, version VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, year INTEGER DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE equipment_software');
        $this->addSql('DROP TABLE software');
    }
}
