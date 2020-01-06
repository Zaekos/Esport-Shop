<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106102248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE peripherique ADD equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE peripherique ADD CONSTRAINT FK_CFCF03656D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_CFCF03656D861B89 ON peripherique (equipe_id)');
        $this->addSql('ALTER TABLE taille_vetement CHANGE libell libellã© VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE accessoire ADD equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accessoire ADD CONSTRAINT FK_8FD026A6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_8FD026A6D861B89 ON accessoire (equipe_id)');
        $this->addSql('ALTER TABLE equipe CHANGE libell libellã© VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CF6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_3CB446CF6D861B89 ON vetement (equipe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accessoire DROP FOREIGN KEY FK_8FD026A6D861B89');
        $this->addSql('DROP INDEX IDX_8FD026A6D861B89 ON accessoire');
        $this->addSql('ALTER TABLE accessoire DROP equipe_id');
        $this->addSql('ALTER TABLE equipe CHANGE libellã© libell VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE peripherique DROP FOREIGN KEY FK_CFCF03656D861B89');
        $this->addSql('DROP INDEX IDX_CFCF03656D861B89 ON peripherique');
        $this->addSql('ALTER TABLE peripherique DROP equipe_id');
        $this->addSql('ALTER TABLE taille_vetement CHANGE libellã© libell VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CF6D861B89');
        $this->addSql('DROP INDEX IDX_3CB446CF6D861B89 ON vetement');
        $this->addSql('ALTER TABLE vetement DROP equipe_id');
    }
}
