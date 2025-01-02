<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250102094407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, address_street VARCHAR(255) DEFAULT NULL, address_number VARCHAR(255) DEFAULT NULL, address_city VARCHAR(255) DEFAULT NULL, address_zip_code VARCHAR(255) DEFAULT NULL, address_country VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education_institution (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, address_street VARCHAR(255) DEFAULT NULL, address_number VARCHAR(255) DEFAULT NULL, address_city VARCHAR(255) DEFAULT NULL, address_zip_code VARCHAR(255) DEFAULT NULL, address_country VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, biography VARCHAR(255) DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, api_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_admins (user_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_9F7F717AA76ED395 (user_id), INDEX IDX_9F7F717A979B1AD6 (company_id), PRIMARY KEY(user_id, company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education_institution_admins (user_id INT NOT NULL, education_institution_id INT NOT NULL, INDEX IDX_56C7E6DEA76ED395 (user_id), INDEX IDX_56C7E6DE5F40C8C8 (education_institution_id), PRIMARY KEY(user_id, education_institution_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_employees (user_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_899949F0A76ED395 (user_id), INDEX IDX_899949F0979B1AD6 (company_id), PRIMARY KEY(user_id, company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_admins ADD CONSTRAINT FK_9F7F717AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_admins ADD CONSTRAINT FK_9F7F717A979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE education_institution_admins ADD CONSTRAINT FK_56C7E6DEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE education_institution_admins ADD CONSTRAINT FK_56C7E6DE5F40C8C8 FOREIGN KEY (education_institution_id) REFERENCES education_institution (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_employees ADD CONSTRAINT FK_899949F0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_employees ADD CONSTRAINT FK_899949F0979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_admins DROP FOREIGN KEY FK_9F7F717AA76ED395');
        $this->addSql('ALTER TABLE company_admins DROP FOREIGN KEY FK_9F7F717A979B1AD6');
        $this->addSql('ALTER TABLE education_institution_admins DROP FOREIGN KEY FK_56C7E6DEA76ED395');
        $this->addSql('ALTER TABLE education_institution_admins DROP FOREIGN KEY FK_56C7E6DE5F40C8C8');
        $this->addSql('ALTER TABLE company_employees DROP FOREIGN KEY FK_899949F0A76ED395');
        $this->addSql('ALTER TABLE company_employees DROP FOREIGN KEY FK_899949F0979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE education_institution');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE company_admins');
        $this->addSql('DROP TABLE education_institution_admins');
        $this->addSql('DROP TABLE company_employees');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
