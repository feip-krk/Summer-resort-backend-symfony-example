<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250521075119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop_contacts (shop_id INT NOT NULL, contact_id INT NOT NULL, PRIMARY KEY(shop_id, contact_id))');
        $this->addSql('CREATE INDEX IDX_E8F8EFE54D16C4DD ON shop_contacts (shop_id)');
        $this->addSql('CREATE INDEX IDX_E8F8EFE5E7A1254A ON shop_contacts (contact_id)');
        $this->addSql('ALTER TABLE shop_contacts ADD CONSTRAINT FK_E8F8EFE54D16C4DD FOREIGN KEY (shop_id) REFERENCES shops (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_contacts ADD CONSTRAINT FK_E8F8EFE5E7A1254A FOREIGN KEY (contact_id) REFERENCES contacts (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop_contacts DROP CONSTRAINT FK_E8F8EFE54D16C4DD');
        $this->addSql('ALTER TABLE shop_contacts DROP CONSTRAINT FK_E8F8EFE5E7A1254A');
        $this->addSql('DROP TABLE shop_contacts');
    }
}
