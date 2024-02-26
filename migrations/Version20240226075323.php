<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226075323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__classroom AS SELECT id, name, description, address, city, zip, country, gauge, floor, parking, price, status, image, admin_id FROM classroom');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('CREATE TABLE classroom (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description CLOB NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(20) NOT NULL, country VARCHAR(50) NOT NULL, gauge INTEGER NOT NULL, floor VARCHAR(255) NOT NULL, parking BOOLEAN NOT NULL, price INTEGER NOT NULL, status BOOLEAN NOT NULL, image VARCHAR(255) DEFAULT NULL, admin_id INTEGER NOT NULL, CONSTRAINT FK_497D309D642B8210 FOREIGN KEY (admin_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO classroom (id, name, description, address, city, zip, country, gauge, floor, parking, price, status, image, admin_id) SELECT id, name, description, address, city, zip, country, gauge, floor, parking, price, status, image, admin_id FROM __temp__classroom');
        $this->addSql('DROP TABLE __temp__classroom');
        $this->addSql('CREATE INDEX IDX_497D309D642B8210 ON classroom (admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__classroom AS SELECT id, name, description, address, city, zip, country, gauge, floor, parking, price, status, image, admin_id FROM classroom');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('CREATE TABLE classroom (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description CLOB NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(20) NOT NULL, country VARCHAR(50) NOT NULL, gauge INTEGER NOT NULL, floor VARCHAR(255) NOT NULL, parking BOOLEAN DEFAULT NULL, price INTEGER NOT NULL, status BOOLEAN DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, admin_id INTEGER DEFAULT NULL, CONSTRAINT FK_497D309D642B8210 FOREIGN KEY (admin_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO classroom (id, name, description, address, city, zip, country, gauge, floor, parking, price, status, image, admin_id) SELECT id, name, description, address, city, zip, country, gauge, floor, parking, price, status, image, admin_id FROM __temp__classroom');
        $this->addSql('DROP TABLE __temp__classroom');
        $this->addSql('CREATE INDEX IDX_497D309D642B8210 ON classroom (admin_id)');
    }
}
