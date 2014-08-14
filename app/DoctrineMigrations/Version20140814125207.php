<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140814125207 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE persona ADD fecha_caduc_tis DATE DEFAULT NULL, 
            ADD orden_expulsion INT DEFAULT NULL, 
            ADD cantidad_ingresospropios VARCHAR(15) DEFAULT NULL, 
            ADD cantidad_ingresospnc VARCHAR(15) DEFAULT NULL, 
            ADD cantidad_ingresosotros VARCHAR(15) DEFAULT NULL, 
            ADD cantidad_ingresosnomina VARCHAR(15) DEFAULT NULL, 
            ADD cantidad_ingresosrentabas VARCHAR(15) DEFAULT NULL, 
            ADD cantidad_ingresosprestcontrib VARCHAR(15) DEFAULT NULL, 
            ADD cantidad_ingrsossedesconoce VARCHAR(15) DEFAULT NULL, 
            ADD cantidad_ingresosayudaindividual VARCHAR(15) DEFAULT NULL, 
            ADD autonomia_economia INT DEFAULT NULL, 
            ADD observaciones_economia VARCHAR(255) DEFAULT NULL, 
            ADD curso_actual VARCHAR(255) DEFAULT NULL, 
            ADD JusticiaGratuita INT DEFAULT NULL
            ");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE persona DROP fecha_caduc_tis, DROP orden_expulsion, DROP cantidad_ingresospropios, DROP cantidad_ingresospnc, DROP cantidad_ingresosotros, DROP cantidad_ingresosnomina, DROP cantidad_ingresosrentabas, DROP cantidad_ingresosprestcontrib, DROP cantidad_ingrsossedesconoce, DROP cantidad_ingresosayudaindividual, DROP autonomia_economia, DROP observaciones_economia, DROP curso_actual, DROP JusticiaGratuita");
    }
}
