<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231223125718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, miniature VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise_unit (exercise_id INT NOT NULL, unit_id INT NOT NULL, INDEX IDX_859E6EE1E934951A (exercise_id), INDEX IDX_859E6EE1F8BD700D (unit_id), PRIMARY KEY(exercise_id, unit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, soft_deleted TINYINT(1) DEFAULT NULL, INDEX IDX_92ED7784A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_exercise (id INT AUTO_INCREMENT NOT NULL, program_id INT NOT NULL, exercise_id INT NOT NULL, sets INT DEFAULT NULL, INDEX IDX_2FEF29293EB8070A (program_id), INDEX IDX_2FEF2929E934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record (id INT AUTO_INCREMENT NOT NULL, unit_id INT NOT NULL, user_id INT NOT NULL, workout_exercise_id INT NOT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', set_id INT NOT NULL, INDEX IDX_9B349F91F8BD700D (unit_id), INDEX IDX_9B349F91A76ED395 (user_id), INDEX IDX_9B349F91E435DB6B (workout_exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, abbreviation VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, min INT NOT NULL, max INT NOT NULL, tick_interval INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout (id INT AUTO_INCREMENT NOT NULL, program_id INT NOT NULL, user_id INT NOT NULL, started_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, planned_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_649FFB723EB8070A (program_id), INDEX IDX_649FFB72A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout_exercise (id INT AUTO_INCREMENT NOT NULL, workout_id INT NOT NULL, exercise_id INT NOT NULL, INDEX IDX_76AB38AAA6CCCFC9 (workout_id), INDEX IDX_76AB38AAE934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise_unit ADD CONSTRAINT FK_859E6EE1E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_unit ADD CONSTRAINT FK_859E6EE1F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE program_exercise ADD CONSTRAINT FK_2FEF29293EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE program_exercise ADD CONSTRAINT FK_2FEF2929E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91E435DB6B FOREIGN KEY (workout_exercise_id) REFERENCES workout_exercise (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB723EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE workout_exercise ADD CONSTRAINT FK_76AB38AAA6CCCFC9 FOREIGN KEY (workout_id) REFERENCES workout (id)');
        $this->addSql('ALTER TABLE workout_exercise ADD CONSTRAINT FK_76AB38AAE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise_unit DROP FOREIGN KEY FK_859E6EE1E934951A');
        $this->addSql('ALTER TABLE exercise_unit DROP FOREIGN KEY FK_859E6EE1F8BD700D');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784A76ED395');
        $this->addSql('ALTER TABLE program_exercise DROP FOREIGN KEY FK_2FEF29293EB8070A');
        $this->addSql('ALTER TABLE program_exercise DROP FOREIGN KEY FK_2FEF2929E934951A');
        $this->addSql('ALTER TABLE record DROP FOREIGN KEY FK_9B349F91F8BD700D');
        $this->addSql('ALTER TABLE record DROP FOREIGN KEY FK_9B349F91A76ED395');
        $this->addSql('ALTER TABLE record DROP FOREIGN KEY FK_9B349F91E435DB6B');
        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB723EB8070A');
        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB72A76ED395');
        $this->addSql('ALTER TABLE workout_exercise DROP FOREIGN KEY FK_76AB38AAA6CCCFC9');
        $this->addSql('ALTER TABLE workout_exercise DROP FOREIGN KEY FK_76AB38AAE934951A');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE exercise_unit');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE program_exercise');
        $this->addSql('DROP TABLE record');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE workout');
        $this->addSql('DROP TABLE workout_exercise');
    }
}
