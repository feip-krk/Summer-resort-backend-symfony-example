<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250521065620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shops ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shops RENAME COLUMN address TO address_string');
        $this->addSql('ALTER TABLE shops ALTER address_string TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE shops ADD CONSTRAINT FK_237A6783F5B7AF75 FOREIGN KEY (address_id) REFERENCES addresses (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_237A6783F5B7AF75 ON shops (address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shops DROP CONSTRAINT FK_237A6783F5B7AF75');
        $this->addSql('DROP INDEX IDX_237A6783F5B7AF75');
        $this->addSql('ALTER TABLE shops DROP address_id');
        $this->addSql('ALTER TABLE shops RENAME COLUMN address_string TO address');
        $this->addSql('ALTER TABLE shops ALTER address TYPE VARCHAR(255)');
    }
}
