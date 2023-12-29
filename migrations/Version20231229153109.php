<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231229153109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise_muscle_group (exercise_id INT NOT NULL, muscle_group_id INT NOT NULL, INDEX IDX_D8A5BCA7E934951A (exercise_id), INDEX IDX_D8A5BCA744004D0 (muscle_group_id), PRIMARY KEY(exercise_id, muscle_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise_exercise_type (exercise_id INT NOT NULL, exercise_type_id INT NOT NULL, INDEX IDX_97A33542E934951A (exercise_id), INDEX IDX_97A335421F597BD6 (exercise_type_id), PRIMARY KEY(exercise_id, exercise_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise_muscle_group ADD CONSTRAINT FK_D8A5BCA7E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_muscle_group ADD CONSTRAINT FK_D8A5BCA744004D0 FOREIGN KEY (muscle_group_id) REFERENCES muscle_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_exercise_type ADD CONSTRAINT FK_97A33542E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_exercise_type ADD CONSTRAINT FK_97A335421F597BD6 FOREIGN KEY (exercise_type_id) REFERENCES exercise_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise_muscle_group DROP FOREIGN KEY FK_D8A5BCA7E934951A');
        $this->addSql('ALTER TABLE exercise_muscle_group DROP FOREIGN KEY FK_D8A5BCA744004D0');
        $this->addSql('ALTER TABLE exercise_exercise_type DROP FOREIGN KEY FK_97A33542E934951A');
        $this->addSql('ALTER TABLE exercise_exercise_type DROP FOREIGN KEY FK_97A335421F597BD6');
        $this->addSql('DROP TABLE exercise_muscle_group');
        $this->addSql('DROP TABLE exercise_exercise_type');
        $this->addSql('DROP TABLE exercise_type');
    }
}
