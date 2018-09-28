<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180508173033 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO dr (nome, estado) VALUES ('Santa Catarina', 'SC')");
        $this->addSql("INSERT INTO dominio_dr (dr_id, dominio) VALUES ((SELECT id FROM dr WHERE nome = 'Santa Catarina'), 'sc.docente.senai.br')");
        $this->addSql("INSERT INTO usuario (email, dr_id, api_key) VALUES ('rafael.s.ribeiro@sc.senai.br', (SELECT id FROM dr WHERE nome = 'Santa Catarina'), 'hN309FOdZZwRkS0iG5ncB6IE7PlMhWkm')");
        $this->addSql("INSERT INTO role (name) VALUES ('ROLE_API')");
        $this->addSql("INSERT INTO usuario_roles (usuario_id, role_id) VALUES ((SELECT id FROM usuario WHERE email = 'rafael.s.ribeiro@sc.senai.br'), (SELECT id FROM role WHERE name = 'ROLE_API'))");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
