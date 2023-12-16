<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216135706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chart (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, exercise_id INT NOT NULL, title JSON NOT NULL, tooltip JSON NOT NULL, plot_options JSON NOT NULL, INDEX IDX_E5562A2AA76ED395 (user_id), INDEX IDX_E5562A2AE934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chart ADD CONSTRAINT FK_E5562A2AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE chart ADD CONSTRAINT FK_E5562A2AE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('ALTER TABLE chart_serie ADD chart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chart_serie ADD CONSTRAINT FK_4C0B2C68BEF83E0A FOREIGN KEY (chart_id) REFERENCES chart (id)');
        $this->addSql('CREATE INDEX IDX_4C0B2C68BEF83E0A ON chart_serie (chart_id)');
        $this->addSql('ALTER TABLE chart_xaxis ADD chart_id INT NOT NULL');
        $this->addSql('ALTER TABLE chart_xaxis ADD CONSTRAINT FK_4DFABAA9BEF83E0A FOREIGN KEY (chart_id) REFERENCES chart (id)');
        $this->addSql('CREATE INDEX IDX_4DFABAA9BEF83E0A ON chart_xaxis (chart_id)');
        $this->addSql('ALTER TABLE chart_yaxis ADD chart_id INT NOT NULL');
        $this->addSql('ALTER TABLE chart_yaxis ADD CONSTRAINT FK_709A9319BEF83E0A FOREIGN KEY (chart_id) REFERENCES chart (id)');
        $this->addSql('CREATE INDEX IDX_709A9319BEF83E0A ON chart_yaxis (chart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart_serie DROP FOREIGN KEY FK_4C0B2C68BEF83E0A');
        $this->addSql('ALTER TABLE chart_xaxis DROP FOREIGN KEY FK_4DFABAA9BEF83E0A');
        $this->addSql('ALTER TABLE chart_yaxis DROP FOREIGN KEY FK_709A9319BEF83E0A');
        $this->addSql('ALTER TABLE chart DROP FOREIGN KEY FK_E5562A2AA76ED395');
        $this->addSql('ALTER TABLE chart DROP FOREIGN KEY FK_E5562A2AE934951A');
        $this->addSql('DROP TABLE chart');
        $this->addSql('DROP INDEX IDX_709A9319BEF83E0A ON chart_yaxis');
        $this->addSql('ALTER TABLE chart_yaxis DROP chart_id');
        $this->addSql('DROP INDEX IDX_4DFABAA9BEF83E0A ON chart_xaxis');
        $this->addSql('ALTER TABLE chart_xaxis DROP chart_id');
        $this->addSql('DROP INDEX IDX_4C0B2C68BEF83E0A ON chart_serie');
        $this->addSql('ALTER TABLE chart_serie DROP chart_id');
    }
}
