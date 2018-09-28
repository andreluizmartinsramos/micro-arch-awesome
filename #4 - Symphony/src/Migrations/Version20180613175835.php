<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180613175835 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE google.evento (id VARCHAR(255) NOT NULL, criador INT DEFAULT NULL, alterador INT DEFAULT NULL, titulo VARCHAR(100) NOT NULL, inicio VARCHAR(20) NOT NULL, termino VARCHAR(20) NOT NULL, html_link VARCHAR(255) NOT NULL, criacao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, alteracao TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9DBF200265D0A412 ON google.evento (criador)');
        $this->addSql('CREATE INDEX IDX_9DBF200279737921 ON google.evento (alterador)');
        $this->addSql('ALTER TABLE google.evento ADD CONSTRAINT FK_9DBF200265D0A412 FOREIGN KEY (criador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE google.evento ADD CONSTRAINT FK_9DBF200279737921 FOREIGN KEY (alterador) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE google.evento');
    }
}
