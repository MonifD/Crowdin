<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605122246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, user_language_id INT DEFAULT NULL, langue VARCHAR(45) NOT NULL, tag VARCHAR(45) NOT NULL, description VARCHAR(45) NOT NULL, INDEX IDX_D4DB71B52BEA7361 (user_language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_cible (id INT AUTO_INCREMENT NOT NULL, language_id INT NOT NULL, INDEX IDX_9E05E86A82F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_origin (id INT AUTO_INCREMENT NOT NULL, language_id INT NOT NULL, UNIQUE INDEX UNIQ_C2E26F7882F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(45) NOT NULL, contenu VARCHAR(450) NOT NULL, INDEX IDX_2FB3D0EEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, nom VARCHAR(45) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_5F8A7F73166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_language (id INT AUTO_INCREMENT NOT NULL, source_id INT NOT NULL, language_cible_id INT NOT NULL, language_origin_id INT NOT NULL, UNIQUE INDEX UNIQ_97FB4767953C1C61 (source_id), UNIQUE INDEX UNIQ_97FB4767C5CC0633 (language_cible_id), UNIQUE INDEX UNIQ_97FB476790C20826 (language_origin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_trad TINYINT(1) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_language (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, language_id INT NOT NULL, level VARCHAR(45) DEFAULT NULL, INDEX IDX_345695B5A76ED395 (user_id), INDEX IDX_345695B582F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B52BEA7361 FOREIGN KEY (user_language_id) REFERENCES user_language (id)');
        $this->addSql('ALTER TABLE language_cible ADD CONSTRAINT FK_9E05E86A82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE language_origin ADD CONSTRAINT FK_C2E26F7882F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F73166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE source_language ADD CONSTRAINT FK_97FB4767953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE source_language ADD CONSTRAINT FK_97FB4767C5CC0633 FOREIGN KEY (language_cible_id) REFERENCES language_cible (id)');
        $this->addSql('ALTER TABLE source_language ADD CONSTRAINT FK_97FB476790C20826 FOREIGN KEY (language_origin_id) REFERENCES language_origin (id)');
        $this->addSql('ALTER TABLE user_language ADD CONSTRAINT FK_345695B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_language ADD CONSTRAINT FK_345695B582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B52BEA7361');
        $this->addSql('ALTER TABLE language_cible DROP FOREIGN KEY FK_9E05E86A82F1BAF4');
        $this->addSql('ALTER TABLE language_origin DROP FOREIGN KEY FK_C2E26F7882F1BAF4');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA76ED395');
        $this->addSql('ALTER TABLE source DROP FOREIGN KEY FK_5F8A7F73166D1F9C');
        $this->addSql('ALTER TABLE source_language DROP FOREIGN KEY FK_97FB4767953C1C61');
        $this->addSql('ALTER TABLE source_language DROP FOREIGN KEY FK_97FB4767C5CC0633');
        $this->addSql('ALTER TABLE source_language DROP FOREIGN KEY FK_97FB476790C20826');
        $this->addSql('ALTER TABLE user_language DROP FOREIGN KEY FK_345695B5A76ED395');
        $this->addSql('ALTER TABLE user_language DROP FOREIGN KEY FK_345695B582F1BAF4');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE language_cible');
        $this->addSql('DROP TABLE language_origin');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE source_language');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_language');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
