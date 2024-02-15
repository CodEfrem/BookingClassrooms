<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215140320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(50) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, status BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, client_id INTEGER NOT NULL, classroom_id INTEGER DEFAULT NULL, CONSTRAINT FK_E00CEDDE19EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E00CEDDE6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE19EB6921 ON booking (client_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE6278D5A8 ON booking (classroom_id)');
        $this->addSql('CREATE TABLE classroom (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description CLOB NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(20) NOT NULL, country VARCHAR(50) NOT NULL, gauge VARCHAR(50) NOT NULL, floor VARCHAR(255) NOT NULL, parking BOOLEAN DEFAULT NULL, price VARCHAR(255) NOT NULL, status BOOLEAN DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, admin_id INTEGER NOT NULL, CONSTRAINT FK_497D309D642B8210 FOREIGN KEY (admin_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_497D309D642B8210 ON classroom (admin_id)');
        $this->addSql('CREATE TABLE classroom_equipment (classroom_id INTEGER NOT NULL, equipment_id INTEGER NOT NULL, PRIMARY KEY(classroom_id, equipment_id), CONSTRAINT FK_620603FE6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_620603FE517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_620603FE6278D5A8 ON classroom_equipment (classroom_id)');
        $this->addSql('CREATE INDEX IDX_620603FE517FE9FE ON classroom_equipment (equipment_id)');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, effective INTEGER NOT NULL, created_at DATETIME NOT NULL, booking_id INTEGER DEFAULT NULL, CONSTRAINT FK_81398E093301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_81398E093301C60 ON customer (booking_id)');
        $this->addSql('CREATE TABLE equipment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, option BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, admin_id INTEGER NOT NULL, CONSTRAINT FK_D338D583642B8210 FOREIGN KEY (admin_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D338D583642B8210 ON equipment (admin_id)');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE classrooms');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE equipments');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookings (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, status BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE classrooms (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL COLLATE "BINARY", description CLOB NOT NULL COLLATE "BINARY", address VARCHAR(255) NOT NULL COLLATE "BINARY", city VARCHAR(50) NOT NULL COLLATE "BINARY", zip VARCHAR(20) NOT NULL COLLATE "BINARY", country VARCHAR(50) NOT NULL COLLATE "BINARY", gauge VARCHAR(50) NOT NULL COLLATE "BINARY", floor VARCHAR(255) NOT NULL COLLATE "BINARY", parking BOOLEAN DEFAULT NULL, price VARCHAR(255) NOT NULL COLLATE "BINARY", status BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE TABLE customers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, effective INTEGER NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE equipments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, option BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE classroom_equipment');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE equipment');
    }
}
