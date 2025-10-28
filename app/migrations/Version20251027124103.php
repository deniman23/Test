<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251027124103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создание таблицы category, связь с book, перевод description в TEXT';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_64C19C15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD category_id INT NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33112469DE2 ON book (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33112469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_CBE5A33112469DE2 ON book');
        $this->addSql('ALTER TABLE book DROP category_id, CHANGE description description VARCHAR(80) DEFAULT NULL');
    }
}
