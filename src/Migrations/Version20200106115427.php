<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106115427 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE taille_vetement CHANGE libell libellã© VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE libell libellã© VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD taille_vetement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CFB468F7AF FOREIGN KEY (taille_vetement_id) REFERENCES taille_vetement (id)');
        $this->addSql('CREATE INDEX IDX_3CB446CFB468F7AF ON vetement (taille_vetement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipe CHANGE libellã© libell VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE taille_vetement CHANGE libellã© libell VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CFB468F7AF');
        $this->addSql('DROP INDEX IDX_3CB446CFB468F7AF ON vetement');
        $this->addSql('ALTER TABLE vetement DROP taille_vetement_id');
    }
}
