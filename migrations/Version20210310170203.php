<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310170203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meter_reading ADD meter_id INT NOT NULL');
        $this->addSql('ALTER TABLE meter_reading ADD CONSTRAINT FK_814A20F96E15CA9E FOREIGN KEY (meter_id) REFERENCES meter (id)');
        $this->addSql('CREATE INDEX IDX_814A20F96E15CA9E ON meter_reading (meter_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meter_reading DROP FOREIGN KEY FK_814A20F96E15CA9E');
        $this->addSql('DROP INDEX IDX_814A20F96E15CA9E ON meter_reading');
        $this->addSql('ALTER TABLE meter_reading DROP meter_id');
    }
}
