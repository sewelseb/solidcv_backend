<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250115131224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_employees DROP FOREIGN KEY FK_899949F0979B1AD6');
        $this->addSql('ALTER TABLE company_employees DROP FOREIGN KEY FK_899949F0A76ED395');
        $this->addSql('DROP TABLE company_employees');
        $this->addSql('ALTER TABLE experience_record ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE experience_record ADD CONSTRAINT FK_6F8378BCA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_6F8378BCA76ED395 ON experience_record (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_employees (user_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_899949F0979B1AD6 (company_id), INDEX IDX_899949F0A76ED395 (user_id), PRIMARY KEY(user_id, company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE company_employees ADD CONSTRAINT FK_899949F0979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_employees ADD CONSTRAINT FK_899949F0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_record DROP FOREIGN KEY FK_6F8378BCA76ED395');
        $this->addSql('DROP INDEX IDX_6F8378BCA76ED395 ON experience_record');
        $this->addSql('ALTER TABLE experience_record DROP user_id');
    }
}
