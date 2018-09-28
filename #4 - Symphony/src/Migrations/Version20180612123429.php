<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180612123429 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE google_usuario ADD escolaridade VARCHAR(80) DEFAULT NULL');
        $this->addSql('ALTER TABLE google_usuario ADD cidade VARCHAR(80) DEFAULT NULL');
        $this->addSql('ALTER TABLE google_usuario ADD estado VARCHAR(80) DEFAULT NULL');
        $this->addSql('ALTER TABLE google_usuario ADD password VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE google_usuario ADD id_plataforma INT DEFAULT NULL');
        $this->addSql('ALTER TABLE google_usuario ADD perfil VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE google_usuario ADD inativo BOOLEAN DEFAULT \'false\' NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER nome DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER nome TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE google_usuario ALTER email_complementar DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER email_complementar TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE google_usuario ALTER nome_mae DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER nome_mae TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE google_usuario ALTER nome_pai DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER nome_pai TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE google_usuario ALTER email_responsavel DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER email_responsavel TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE google_usuario ALTER data_nascimento TYPE VARCHAR(15)');
        $this->addSql('ALTER TABLE google_usuario ALTER cpf DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER cpf TYPE VARCHAR(15)');
        $this->addSql('ALTER TABLE google_usuario ALTER celular DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER celular TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE google_usuario ALTER telefone DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER telefone TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE google_usuario ALTER matricula DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER unidade DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER unidade TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE google_usuario ALTER genero DROP NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER genero TYPE VARCHAR(15)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE google_usuario DROP escolaridade');
        $this->addSql('ALTER TABLE google_usuario DROP cidade');
        $this->addSql('ALTER TABLE google_usuario DROP estado');
        $this->addSql('ALTER TABLE google_usuario DROP password');
        $this->addSql('ALTER TABLE google_usuario DROP id_plataforma');
        $this->addSql('ALTER TABLE google_usuario DROP perfil');
        $this->addSql('ALTER TABLE google_usuario DROP inativo');
        $this->addSql('ALTER TABLE google_usuario ALTER nome SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER nome TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER email_complementar SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER email_complementar TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER nome_mae SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER nome_mae TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER nome_pai SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER nome_pai TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER email_responsavel SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER email_responsavel TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER data_nascimento TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER cpf SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER cpf TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER celular SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER celular TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER telefone SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER telefone TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER matricula SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER unidade SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER unidade TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE google_usuario ALTER genero SET NOT NULL');
        $this->addSql('ALTER TABLE google_usuario ALTER genero TYPE VARCHAR(255)');
    }
}
