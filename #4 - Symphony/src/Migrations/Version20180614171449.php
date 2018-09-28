<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180614171449 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE usuario_calendario (usuario_id INT NOT NULL, calendario_id VARCHAR(255) NOT NULL, PRIMARY KEY(usuario_id, calendario_id))');
        $this->addSql('CREATE INDEX IDX_DC29E12EDB38439E ON usuario_calendario (usuario_id)');
        $this->addSql('CREATE INDEX IDX_DC29E12EA7F6EA19 ON usuario_calendario (calendario_id)');
        $this->addSql('ALTER TABLE usuario_calendario ADD CONSTRAINT FK_DC29E12EDB38439E FOREIGN KEY (usuario_id) REFERENCES google.usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usuario_calendario ADD CONSTRAINT FK_DC29E12EA7F6EA19 FOREIGN KEY (calendario_id) REFERENCES google.calendario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE usuario_calendario');
    }
}
