<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190112141146 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE picture CHANGE picture picture LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_date_online last_date_online DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment CHANGE date date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE picture CHANGE picture picture LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_date_online last_date_online DATETIME DEFAULT NULL');
    }
}
