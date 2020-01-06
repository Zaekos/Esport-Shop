<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106095333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE peripherique ADD in_stock TINYINT(1) DEFAULT NULL, CHANGE en_avant en_avant TINYINT(1) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE taille_vetement CHANGE libell libellã© VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE accessoire ADD in_stock TINYINT(1) DEFAULT NULL, CHANGE en_avant en_avant TINYINT(1) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE libell libellã© VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD created_at DATETIME DEFAULT NULL, ADD in_stock TINYINT(1) DEFAULT NULL, DROP creation, CHANGE en_avant en_avant TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accessoire DROP in_stock, CHANGE en_avant en_avant TINYINT(1) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE libellã© libell VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE peripherique DROP in_stock, CHANGE en_avant en_avant TINYINT(1) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE taille_vetement CHANGE libellã© libell VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE vetement ADD creation DATETIME NOT NULL, DROP created_at, DROP in_stock, CHANGE en_avant en_avant TINYINT(1) NOT NULL');
    }
}
