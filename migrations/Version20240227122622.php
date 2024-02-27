<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227122622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id, customers FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(50) DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, amount INTEGER DEFAULT NULL, status BOOLEAN DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, client_id INTEGER DEFAULT NULL, classroom_id INTEGER DEFAULT NULL, customers INTEGER DEFAULT NULL, CONSTRAINT FK_E00CEDDE19EB6921 FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E00CEDDE6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO booking (id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id, customers) SELECT id, number, start_date, end_date, amount, status, created_at, updated_at, client_id, classroom_id, customers FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDE6278D5A8 ON booking (classroom_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE19EB6921 ON booking (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, number, start_date, end_date, customers, amount, status, created_at, updated_at, client_id, classroom_id FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(50) DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, customers INTEGER DEFAULT NULL, amount INTEGER DEFAULT NULL, status BOOLEAN DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, client_id INTEGER NOT NULL, classroom_id INTEGER DEFAULT NULL, CONSTRAINT FK_E00CEDDE19EB6921 FOREIGN KEY (client_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E00CEDDE6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO booking (id, number, start_date, end_date, customers, amount, status, created_at, updated_at, client_id, classroom_id) SELECT id, number, start_date, end_date, customers, amount, status, created_at, updated_at, client_id, classroom_id FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDE19EB6921 ON booking (client_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE6278D5A8 ON booking (classroom_id)');
    }
}
