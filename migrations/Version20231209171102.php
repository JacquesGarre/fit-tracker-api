<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231209171102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise_unit (exercise_id INT NOT NULL, unit_id INT NOT NULL, INDEX IDX_859E6EE1E934951A (exercise_id), INDEX IDX_859E6EE1F8BD700D (unit_id), PRIMARY KEY(exercise_id, unit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise_unit ADD CONSTRAINT FK_859E6EE1E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_unit ADD CONSTRAINT FK_859E6EE1F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise_unit DROP FOREIGN KEY FK_859E6EE1E934951A');
        $this->addSql('ALTER TABLE exercise_unit DROP FOREIGN KEY FK_859E6EE1F8BD700D');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE exercise_unit');
    }
}
