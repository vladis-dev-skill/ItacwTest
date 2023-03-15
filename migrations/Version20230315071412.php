<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315071412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "country" (id VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, tax INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "country".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "country".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE "client" RENAME COLUMN address TO country_id');
        $this->addSql('ALTER TABLE "client" ADD CONSTRAINT FK_C7440455F92F3E70 FOREIGN KEY (country_id) REFERENCES "country" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C7440455F92F3E70 ON "client" (country_id)');
        $this->addSql('ALTER TABLE "salesman" RENAME COLUMN address TO country_id');
        $this->addSql('ALTER TABLE "salesman" ADD CONSTRAINT FK_ABB178EFF92F3E70 FOREIGN KEY (country_id) REFERENCES "country" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ABB178EFF92F3E70 ON "salesman" (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "client" DROP CONSTRAINT FK_C7440455F92F3E70');
        $this->addSql('ALTER TABLE "salesman" DROP CONSTRAINT FK_ABB178EFF92F3E70');
        $this->addSql('DROP TABLE "country"');
        $this->addSql('DROP INDEX IDX_C7440455F92F3E70');
        $this->addSql('ALTER TABLE "client" RENAME COLUMN country_id TO address');
        $this->addSql('DROP INDEX IDX_ABB178EFF92F3E70');
        $this->addSql('ALTER TABLE "salesman" RENAME COLUMN country_id TO address');
    }
}
