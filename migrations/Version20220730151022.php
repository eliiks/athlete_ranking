<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220730151022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrator (id INT AUTO_INCREMENT NOT NULL, club_id_id INT NOT NULL, login VARCHAR(45) NOT NULL, password VARCHAR(45) NOT NULL, INDEX IDX_58DF0651DF2AB4E5 (club_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE athlete (id INT AUTO_INCREMENT NOT NULL, club_id_id INT NOT NULL, categorie_id_id INT NOT NULL, first_name VARCHAR(45) NOT NULL, last_name VARCHAR(45) NOT NULL, nb_points INT NOT NULL, INDEX IDX_C03B8321DF2AB4E5 (club_id_id), INDEX IDX_C03B83218A3C7387 (categorie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, long_name VARCHAR(45) NOT NULL, short_name VARCHAR(3) NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, description VARCHAR(45) DEFAULT NULL, admin_code VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_B8EE3872570CB278 (admin_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, club_id_id INT NOT NULL, name VARCHAR(45) NOT NULL, nb_points INT NOT NULL, INDEX IDX_3BAE0AA7DF2AB4E5 (club_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, athlete_id INT NOT NULL, INDEX IDX_AB55E24F71F7E88B (event_id), INDEX IDX_AB55E24FFE6BCB8B (athlete_id), UNIQUE INDEX participation_idx (event_id, athlete_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrator ADD CONSTRAINT FK_58DF0651DF2AB4E5 FOREIGN KEY (club_id_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B8321DF2AB4E5 FOREIGN KEY (club_id_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B83218A3C7387 FOREIGN KEY (categorie_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7DF2AB4E5 FOREIGN KEY (club_id_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FFE6BCB8B FOREIGN KEY (athlete_id) REFERENCES athlete (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FFE6BCB8B');
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B83218A3C7387');
        $this->addSql('ALTER TABLE administrator DROP FOREIGN KEY FK_58DF0651DF2AB4E5');
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B8321DF2AB4E5');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7DF2AB4E5');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F71F7E88B');
        $this->addSql('DROP TABLE administrator');
        $this->addSql('DROP TABLE athlete');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE participation');
    }
}
