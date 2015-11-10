<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151110154247 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE scrum_agile_project (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, title VARCHAR(128) NOT NULL, description LONGTEXT NOT NULL, support_email VARCHAR(128) NOT NULL, created_at DATE NOT NULL, updated_at DATE NOT NULL, INDEX IDX_910563F3B03A8386 (created_by_id), INDEX IDX_910563F3896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scrum_agile_project ADD CONSTRAINT FK_910563F3B03A8386 FOREIGN KEY (created_by_id) REFERENCES scrum_agile_user (id)');
        $this->addSql('ALTER TABLE scrum_agile_project ADD CONSTRAINT FK_910563F3896DBBDE FOREIGN KEY (updated_by_id) REFERENCES scrum_agile_user (id)');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE user');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_6DC044C55E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, username_canonical VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, email_canonical VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE scrum_agile_project');
    }
}
