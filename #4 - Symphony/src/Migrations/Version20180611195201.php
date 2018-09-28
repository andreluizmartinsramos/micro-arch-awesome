<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180611195201 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE google_usuario (id SERIAL NOT NULL, criador INT DEFAULT NULL, alterador INT DEFAULT NULL, email VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL, email_complementar VARCHAR(255) NOT NULL, nome_mae VARCHAR(255) NOT NULL, nome_pai VARCHAR(255) NOT NULL, email_responsavel VARCHAR(255) NOT NULL, data_nascimento VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, celular VARCHAR(255) NOT NULL, telefone VARCHAR(255) NOT NULL, matricula INT NOT NULL, unidade VARCHAR(255) NOT NULL, genero VARCHAR(255) NOT NULL, criacao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, alteracao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DC218DDBE7927C74 ON google_usuario (email)');
        $this->addSql('CREATE INDEX IDX_DC218DDB65D0A412 ON google_usuario (criador)');
        $this->addSql('CREATE INDEX IDX_DC218DDB79737921 ON google_usuario (alterador)');
        $this->addSql('ALTER TABLE google_usuario ADD CONSTRAINT FK_DC218DDB65D0A412 FOREIGN KEY (criador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE google_usuario ADD CONSTRAINT FK_DC218DDB79737921 FOREIGN KEY (alterador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE google_usuario');
    }
}
