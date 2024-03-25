<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318124307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste ADD nationalitée_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artiste ADD CONSTRAINT FK_9C07354F3ED465 FOREIGN KEY (nationalitée_id) REFERENCES nationalite (id)');
        $this->addSql('CREATE INDEX IDX_9C07354F3ED465 ON artiste (nationalitée_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste DROP FOREIGN KEY FK_9C07354F3ED465');
        $this->addSql('DROP INDEX IDX_9C07354F3ED465 ON artiste');
        $this->addSql('ALTER TABLE artiste DROP nationalitée_id');
    }
}
