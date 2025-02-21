<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250221160940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manually_added_work_experience (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, start_date INT DEFAULT NULL, end_date INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, INDEX IDX_715DF061A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE manually_added_work_experience ADD CONSTRAINT FK_715DF061A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE manually_added_work_experience DROP FOREIGN KEY FK_715DF061A76ED395');
        $this->addSql('DROP TABLE manually_added_work_experience');
    }
}
