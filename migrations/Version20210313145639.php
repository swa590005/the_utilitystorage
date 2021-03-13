<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313145639 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE heater_reading ADD heater_id INT NOT NULL');
        $this->addSql('ALTER TABLE heater_reading ADD CONSTRAINT FK_B90466B12D2F1D43 FOREIGN KEY (heater_id) REFERENCES heater (id)');
        $this->addSql('CREATE INDEX IDX_B90466B12D2F1D43 ON heater_reading (heater_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE heater_reading DROP FOREIGN KEY FK_B90466B12D2F1D43');
        $this->addSql('DROP INDEX IDX_B90466B12D2F1D43 ON heater_reading');
        $this->addSql('ALTER TABLE heater_reading DROP heater_id');
    }
}
