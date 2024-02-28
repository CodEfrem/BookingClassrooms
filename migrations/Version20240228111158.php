<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228111158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE equipment_software');
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(50) DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, amount INTEGER DEFAULT NULL, status BOOLEAN DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, client_id INTEGER DEFAULT NULL, classroom_id INTEGER DEFAULT NULL, customers INTEGER DEFAULT NULL, CONSTRAINT FK_E00CEDDE19EB6921 FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E00CEDDE6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO booking (id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id) SELECT id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDE6278D5A8 ON booking (classroom_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE19EB6921 ON booking (client_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__equipment AS SELECT id, option, created_at, updated_at, admin_id FROM equipment');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('CREATE TABLE equipment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, option VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, admin_id INTEGER DEFAULT NULL, CONSTRAINT FK_D338D583642B8210 FOREIGN KEY (admin_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO equipment (id, option, created_at, updated_at, admin_id) SELECT id, option, created_at, updated_at, admin_id FROM __temp__equipment');
        $this->addSql('DROP TABLE __temp__equipment');
        $this->addSql('CREATE INDEX IDX_D338D583642B8210 ON equipment (admin_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at, is_verified FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) DEFAULT NULL, corporate_name VARCHAR(100) DEFAULT NULL, siret VARCHAR(17) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, zip VARCHAR(20) DEFAULT NULL, country VARCHAR(50) DEFAULT NULL, consent BOOLEAN DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at, is_verified) SELECT id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at, is_verified FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, effective INTEGER NOT NULL, created_at DATETIME NOT NULL, booking_id INTEGER DEFAULT NULL, CONSTRAINT FK_81398E093301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_81398E093301C60 ON customer (booking_id)');
        $this->addSql('CREATE TABLE equipment_software (equipment_id INTEGER NOT NULL, software_id INTEGER NOT NULL, PRIMARY KEY(equipment_id, software_id), CONSTRAINT FK_4713ECE9517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4713ECE9D7452741 FOREIGN KEY (software_id) REFERENCES software (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_4713ECE9D7452741 ON equipment_software (software_id)');
        $this->addSql('CREATE INDEX IDX_4713ECE9517FE9FE ON equipment_software (equipment_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(50) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, status BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, client_id INTEGER NOT NULL, classroom_id INTEGER DEFAULT NULL, CONSTRAINT FK_E00CEDDE19EB6921 FOREIGN KEY (client_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E00CEDDE6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO booking (id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id) SELECT id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDE19EB6921 ON booking (client_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE6278D5A8 ON booking (classroom_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__equipment AS SELECT id, option, created_at, updated_at, admin_id FROM equipment');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('CREATE TABLE equipment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, option VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, admin_id INTEGER NOT NULL, CONSTRAINT FK_D338D583642B8210 FOREIGN KEY (admin_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO equipment (id, option, created_at, updated_at, admin_id) SELECT id, option, created_at, updated_at, admin_id FROM __temp__equipment');
        $this->addSql('DROP TABLE __temp__equipment');
        $this->addSql('CREATE INDEX IDX_D338D583642B8210 ON equipment (admin_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at, is_verified FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, corporate_name VARCHAR(100) NOT NULL, siret VARCHAR(14) NOT NULL, phone VARCHAR(15) DEFAULT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(20) NOT NULL, country VARCHAR(50) NOT NULL, consent BOOLEAN DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at, is_verified) SELECT id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at, is_verified FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
