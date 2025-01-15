<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250115132827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience_record ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE experience_record ADD CONSTRAINT FK_6F8378BC979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_6F8378BC979B1AD6 ON experience_record (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience_record DROP FOREIGN KEY FK_6F8378BC979B1AD6');
        $this->addSql('DROP INDEX IDX_6F8378BC979B1AD6 ON experience_record');
        $this->addSql('ALTER TABLE experience_record DROP company_id');
    }
}
