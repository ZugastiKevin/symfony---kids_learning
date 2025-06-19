<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250619074722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE lessons (id INT AUTO_INCREMENT NOT NULL, matter_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, last TIME NOT NULL, INDEX IDX_3F4218D9D614E59F (matter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE matter (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE resources (id INT AUTO_INCREMENT NOT NULL, lessons_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_EF66EBAEFED07355 (lessons_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D9D614E59F FOREIGN KEY (matter_id) REFERENCES matter (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE resources ADD CONSTRAINT FK_EF66EBAEFED07355 FOREIGN KEY (lessons_id) REFERENCES lessons (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE lessons DROP FOREIGN KEY FK_3F4218D9D614E59F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE resources DROP FOREIGN KEY FK_EF66EBAEFED07355
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lessons
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE matter
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE resources
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
