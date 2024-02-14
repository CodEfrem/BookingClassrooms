<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214100910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookings (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, status BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE classrooms (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description CLOB NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(20) NOT NULL, country VARCHAR(50) NOT NULL, gauge VARCHAR(50) NOT NULL, floor VARCHAR(255) NOT NULL, parking BOOLEAN DEFAULT NULL, price VARCHAR(255) NOT NULL, status BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE TABLE customers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, effective INTEGER NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE equipments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, option BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, corporate_name VARCHAR(100) NOT NULL, siret VARCHAR(14) NOT NULL, phone VARCHAR(15) DEFAULT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(20) NOT NULL, country VARCHAR(50) NOT NULL, consent BOOLEAN DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE classrooms');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE equipments');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
