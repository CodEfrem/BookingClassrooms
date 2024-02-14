<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214135913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD COLUMN is_verified BOOLEAN NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, corporate_name VARCHAR(100) NOT NULL, siret VARCHAR(14) NOT NULL, phone VARCHAR(15) DEFAULT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(20) NOT NULL, country VARCHAR(50) NOT NULL, consent BOOLEAN DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO "user" (id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at) SELECT id, email, roles, password, name, corporate_name, siret, phone, address, city, zip, country, consent, created_at, updated_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
    }
}
