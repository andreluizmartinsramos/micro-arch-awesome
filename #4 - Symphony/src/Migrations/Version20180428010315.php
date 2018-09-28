<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180428010315 extends AbstractMigration
{
    public function up(Schema $schema) {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE dominio_dr (id SERIAL NOT NULL, dr_id INT NOT NULL, dominio VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F07F7528F2A652A5 ON dominio_dr (dr_id)');
        $this->addSql('CREATE TABLE dr (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, estado VARCHAR(2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE role (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE usuario (id SERIAL NOT NULL, dr_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, api_key VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DE7927C74 ON usuario (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DC912ED9D ON usuario (api_key)');
        $this->addSql('CREATE INDEX IDX_2265B05DF2A652A5 ON usuario (dr_id)');
        $this->addSql('CREATE TABLE usuario_roles (usuario_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(usuario_id, role_id))');
        $this->addSql('CREATE INDEX IDX_ABE044D9DB38439E ON usuario_roles (usuario_id)');
        $this->addSql('CREATE INDEX IDX_ABE044D9D60322AC ON usuario_roles (role_id)');
        $this->addSql('ALTER TABLE dominio_dr ADD CONSTRAINT FK_F07F7528F2A652A5 FOREIGN KEY (dr_id) REFERENCES dr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DF2A652A5 FOREIGN KEY (dr_id) REFERENCES dr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usuario_roles ADD CONSTRAINT FK_ABE044D9DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usuario_roles ADD CONSTRAINT FK_ABE044D9D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dominio_dr DROP CONSTRAINT FK_F07F7528F2A652A5');
        $this->addSql('ALTER TABLE usuario DROP CONSTRAINT FK_2265B05DF2A652A5');
        $this->addSql('ALTER TABLE usuario_roles DROP CONSTRAINT FK_ABE044D9D60322AC');
        $this->addSql('ALTER TABLE usuario_roles DROP CONSTRAINT FK_ABE044D9DB38439E');
        $this->addSql('DROP TABLE dominio_dr');
        $this->addSql('DROP TABLE dr');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_roles');
    }
}
