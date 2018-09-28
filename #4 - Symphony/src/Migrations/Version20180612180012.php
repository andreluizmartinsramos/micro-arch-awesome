<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180612180012 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA google');
        $this->addSql('DROP SEQUENCE google_usuario_id_seq CASCADE');
        $this->addSql('CREATE TABLE google.calendario (id VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE google.usuario (id SERIAL NOT NULL, criador INT DEFAULT NULL, alterador INT DEFAULT NULL, tipo VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, nome VARCHAR(80) DEFAULT NULL, email_complementar VARCHAR(80) DEFAULT NULL, nome_mae VARCHAR(80) DEFAULT NULL, nome_pai VARCHAR(80) DEFAULT NULL, email_responsavel VARCHAR(80) DEFAULT NULL, data_nascimento VARCHAR(15) DEFAULT NULL, cpf VARCHAR(15) DEFAULT NULL, celular VARCHAR(20) DEFAULT NULL, telefone VARCHAR(20) DEFAULT NULL, matricula INT DEFAULT NULL, unidade VARCHAR(80) DEFAULT NULL, genero VARCHAR(15) DEFAULT NULL, escolaridade VARCHAR(80) DEFAULT NULL, cidade VARCHAR(80) DEFAULT NULL, estado VARCHAR(80) DEFAULT NULL, password VARCHAR(50) DEFAULT NULL, id_plataforma INT DEFAULT NULL, perfil VARCHAR(50) DEFAULT NULL, inativo BOOLEAN DEFAULT \'false\' NOT NULL, criacao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, alteracao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BCDB1CD5E7927C74 ON google.usuario (email)');
        $this->addSql('CREATE INDEX IDX_BCDB1CD565D0A412 ON google.usuario (criador)');
        $this->addSql('CREATE INDEX IDX_BCDB1CD579737921 ON google.usuario (alterador)');
        $this->addSql('ALTER TABLE google.usuario ADD CONSTRAINT FK_BCDB1CD565D0A412 FOREIGN KEY (criador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE google.usuario ADD CONSTRAINT FK_BCDB1CD579737921 FOREIGN KEY (alterador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE google_usuario');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE google_usuario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE google_usuario (id SERIAL NOT NULL, criador INT DEFAULT NULL, alterador INT DEFAULT NULL, email VARCHAR(255) NOT NULL, nome VARCHAR(80) DEFAULT NULL, email_complementar VARCHAR(80) DEFAULT NULL, nome_mae VARCHAR(80) DEFAULT NULL, nome_pai VARCHAR(80) DEFAULT NULL, email_responsavel VARCHAR(80) DEFAULT NULL, data_nascimento VARCHAR(15) DEFAULT NULL, cpf VARCHAR(15) DEFAULT NULL, celular VARCHAR(20) DEFAULT NULL, telefone VARCHAR(20) DEFAULT NULL, matricula INT DEFAULT NULL, unidade VARCHAR(80) DEFAULT NULL, genero VARCHAR(15) DEFAULT NULL, criacao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, alteracao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, escolaridade VARCHAR(80) DEFAULT NULL, cidade VARCHAR(80) DEFAULT NULL, estado VARCHAR(80) DEFAULT NULL, password VARCHAR(50) DEFAULT NULL, id_plataforma INT DEFAULT NULL, perfil VARCHAR(50) DEFAULT NULL, inativo BOOLEAN DEFAULT \'false\' NOT NULL, tipo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_dc218ddb79737921 ON google_usuario (alterador)');
        $this->addSql('CREATE INDEX idx_dc218ddb65d0a412 ON google_usuario (criador)');
        $this->addSql('CREATE UNIQUE INDEX uniq_dc218ddbe7927c74 ON google_usuario (email)');
        $this->addSql('ALTER TABLE google_usuario ADD CONSTRAINT fk_dc218ddb65d0a412 FOREIGN KEY (criador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE google_usuario ADD CONSTRAINT fk_dc218ddb79737921 FOREIGN KEY (alterador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE google.calendario');
        $this->addSql('DROP TABLE google.usuario');
    }
}
