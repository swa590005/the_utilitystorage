<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210306170657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE heater ADD room_id INT NOT NULL');
        $this->addSql('ALTER TABLE heater ADD CONSTRAINT FK_72540BB154177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_72540BB154177093 ON heater (room_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE heater DROP FOREIGN KEY FK_72540BB154177093');
        $this->addSql('DROP INDEX IDX_72540BB154177093 ON heater');
        $this->addSql('ALTER TABLE heater DROP room_id');
    }
}
