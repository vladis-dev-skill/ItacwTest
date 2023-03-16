<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316162426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "client" DROP CONSTRAINT fk_c7440455f92f3e70');
        $this->addSql('DROP INDEX idx_c7440455f92f3e70');
        $this->addSql('ALTER TABLE "client" DROP country_id');
        $this->addSql('ALTER TABLE "country" ADD prefix VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "product" ALTER price DROP NOT NULL');
        $this->addSql('ALTER TABLE "salesman" DROP CONSTRAINT fk_abb178eff92f3e70');
        $this->addSql('DROP INDEX idx_abb178eff92f3e70');
        $this->addSql('ALTER TABLE "salesman" RENAME COLUMN country_id TO tax_number');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "client" ADD country_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "client" ADD CONSTRAINT fk_c7440455f92f3e70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c7440455f92f3e70 ON "client" (country_id)');
        $this->addSql('ALTER TABLE "salesman" RENAME COLUMN tax_number TO country_id');
        $this->addSql('ALTER TABLE "salesman" ADD CONSTRAINT fk_abb178eff92f3e70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_abb178eff92f3e70 ON "salesman" (country_id)');
        $this->addSql('ALTER TABLE "country" DROP prefix');
        $this->addSql('ALTER TABLE "product" ALTER price SET NOT NULL');
    }
}
