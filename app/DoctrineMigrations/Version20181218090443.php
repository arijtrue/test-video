<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20181218090443 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, added_by_id INT NOT NULL, title VARCHAR(1024) NOT NULL, description VARCHAR(8196) NOT NULL, year VARCHAR(4) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_7CC7DA2C55B127A4 (added_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C55B127A4 FOREIGN KEY (added_by_id) REFERENCES fos_user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE video');
    }
}
