<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250218174443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificate ADD user_id INT DEFAULT NULL, ADD education_institution_id INT DEFAULT NULL, ADD ethereum_token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4A5F40C8C8 FOREIGN KEY (education_institution_id) REFERENCES education_institution (id)');
        $this->addSql('CREATE INDEX IDX_219CDA4AA76ED395 ON certificate (user_id)');
        $this->addSql('CREATE INDEX IDX_219CDA4A5F40C8C8 ON certificate (education_institution_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4AA76ED395');
        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4A5F40C8C8');
        $this->addSql('DROP INDEX IDX_219CDA4AA76ED395 ON certificate');
        $this->addSql('DROP INDEX IDX_219CDA4A5F40C8C8 ON certificate');
        $this->addSql('ALTER TABLE certificate DROP user_id, DROP education_institution_id, DROP ethereum_token');
    }
}
