<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140814113227 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE comentario CHANGE id_actividad id_actividad INT DEFAULT NULL, CHANGE hito hito INT DEFAULT NULL");
        $this->addSql("ALTER TABLE alta_baja CHANGE id_unico id_unico INT DEFAULT NULL, CHANGE alta_baja alta_baja VARCHAR(1) DEFAULT NULL, CHANGE fecha_inserc fecha_inserc DATETIME DEFAULT NULL");
        $this->addSql("ALTER TABLE tutor CHANGE ultima_cx ultima_cx DATETIME NOT NULL");
        $this->addSql("ALTER TABLE pei CHANGE fecha_creacion fecha_creacion DATETIME NOT NULL");
        $this->addSql("ALTER TABLE persona CHANGE telefonos_interes telefonos_interes VARCHAR(512) DEFAULT NULL");
        $this->addSql("ALTER TABLE varios CHANGE fecha_cambio fecha_cambio DATETIME DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE alta_baja CHANGE id_unico id_unico INT NOT NULL, CHANGE alta_baja alta_baja CHAR(1) DEFAULT NULL, CHANGE fecha_inserc fecha_inserc DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->addSql("ALTER TABLE comentario CHANGE id_actividad id_actividad INT DEFAULT 1, CHANGE hito hito INT DEFAULT 0");
        $this->addSql("ALTER TABLE pei CHANGE fecha_creacion fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL");
        $this->addSql("ALTER TABLE persona CHANGE telefonos_interes telefonos_interes VARCHAR(512) DEFAULT ' '");
        $this->addSql("ALTER TABLE tutor CHANGE ultima_cx ultima_cx DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL");
        $this->addSql("ALTER TABLE varios CHANGE fecha_cambio fecha_cambio DATETIME DEFAULT '0000-00-00 00:00:00'");
    }
}
