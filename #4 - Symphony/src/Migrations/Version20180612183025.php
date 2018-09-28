<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180612183025 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE google.calendario ADD criador INT DEFAULT NULL');
        $this->addSql('ALTER TABLE google.calendario ADD alterador INT DEFAULT NULL');
        $this->addSql('ALTER TABLE google.calendario ADD titulo VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE google.calendario ADD descricao VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE google.calendario ADD local VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE google.calendario ADD criacao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE google.calendario ADD alteracao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE google.calendario ADD CONSTRAINT FK_EE548C4465D0A412 FOREIGN KEY (criador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE google.calendario ADD CONSTRAINT FK_EE548C4479737921 FOREIGN KEY (alterador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EE548C4465D0A412 ON google.calendario (criador)');
        $this->addSql('CREATE INDEX IDX_EE548C4479737921 ON google.calendario (alterador)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE google.calendario DROP CONSTRAINT FK_EE548C4465D0A412');
        $this->addSql('ALTER TABLE google.calendario DROP CONSTRAINT FK_EE548C4479737921');
        $this->addSql('DROP INDEX IDX_EE548C4465D0A412');
        $this->addSql('DROP INDEX IDX_EE548C4479737921');
        $this->addSql('ALTER TABLE google.calendario DROP criador');
        $this->addSql('ALTER TABLE google.calendario DROP alterador');
        $this->addSql('ALTER TABLE google.calendario DROP titulo');
        $this->addSql('ALTER TABLE google.calendario DROP descricao');
        $this->addSql('ALTER TABLE google.calendario DROP local');
        $this->addSql('ALTER TABLE google.calendario DROP criacao');
        $this->addSql('ALTER TABLE google.calendario DROP alteracao');
    }
}
