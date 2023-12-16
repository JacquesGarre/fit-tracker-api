<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216145357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart_serie ADD unit_id INT NOT NULL');
        $this->addSql('ALTER TABLE chart_serie ADD CONSTRAINT FK_4C0B2C68F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('CREATE INDEX IDX_4C0B2C68F8BD700D ON chart_serie (unit_id)');
        $this->addSql('ALTER TABLE chart_yaxis ADD unit_id INT NOT NULL');
        $this->addSql('ALTER TABLE chart_yaxis ADD CONSTRAINT FK_709A9319F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('CREATE INDEX IDX_709A9319F8BD700D ON chart_yaxis (unit_id)');
        $this->addSql('ALTER TABLE unit ADD color VARCHAR(255) NOT NULL, ADD min INT NOT NULL, ADD max INT NOT NULL, ADD tick_interval INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart_yaxis DROP FOREIGN KEY FK_709A9319F8BD700D');
        $this->addSql('DROP INDEX IDX_709A9319F8BD700D ON chart_yaxis');
        $this->addSql('ALTER TABLE chart_yaxis DROP unit_id');
        $this->addSql('ALTER TABLE unit DROP color, DROP min, DROP max, DROP tick_interval');
        $this->addSql('ALTER TABLE chart_serie DROP FOREIGN KEY FK_4C0B2C68F8BD700D');
        $this->addSql('DROP INDEX IDX_4C0B2C68F8BD700D ON chart_serie');
        $this->addSql('ALTER TABLE chart_serie DROP unit_id');
    }
}
