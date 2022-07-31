<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220731155919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrator DROP FOREIGN KEY FK_58DF0651DF2AB4E5');
        $this->addSql('DROP INDEX IDX_58DF0651DF2AB4E5 ON administrator');
        $this->addSql('ALTER TABLE administrator CHANGE club_id_id club_id INT NOT NULL');
        $this->addSql('ALTER TABLE administrator ADD CONSTRAINT FK_58DF065161190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_58DF065161190A32 ON administrator (club_id)');
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B83218A3C7387');
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B8321DF2AB4E5');
        $this->addSql('DROP INDEX IDX_C03B8321DF2AB4E5 ON athlete');
        $this->addSql('DROP INDEX IDX_C03B83218A3C7387 ON athlete');
        $this->addSql('ALTER TABLE athlete ADD club_id INT NOT NULL, ADD categorie_id INT NOT NULL, DROP club_id_id, DROP categorie_id_id');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B832161190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B8321BCF5E72D FOREIGN KEY (categorie_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_C03B832161190A32 ON athlete (club_id)');
        $this->addSql('CREATE INDEX IDX_C03B8321BCF5E72D ON athlete (categorie_id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7DF2AB4E5');
        $this->addSql('DROP INDEX IDX_3BAE0AA7DF2AB4E5 ON event');
        $this->addSql('ALTER TABLE event CHANGE club_id_id club_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA761190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA761190A32 ON event (club_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrator DROP FOREIGN KEY FK_58DF065161190A32');
        $this->addSql('DROP INDEX IDX_58DF065161190A32 ON administrator');
        $this->addSql('ALTER TABLE administrator CHANGE club_id club_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE administrator ADD CONSTRAINT FK_58DF0651DF2AB4E5 FOREIGN KEY (club_id_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_58DF0651DF2AB4E5 ON administrator (club_id_id)');
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B832161190A32');
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B8321BCF5E72D');
        $this->addSql('DROP INDEX IDX_C03B832161190A32 ON athlete');
        $this->addSql('DROP INDEX IDX_C03B8321BCF5E72D ON athlete');
        $this->addSql('ALTER TABLE athlete ADD club_id_id INT NOT NULL, ADD categorie_id_id INT NOT NULL, DROP club_id, DROP categorie_id');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B83218A3C7387 FOREIGN KEY (categorie_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B8321DF2AB4E5 FOREIGN KEY (club_id_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_C03B8321DF2AB4E5 ON athlete (club_id_id)');
        $this->addSql('CREATE INDEX IDX_C03B83218A3C7387 ON athlete (categorie_id_id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA761190A32');
        $this->addSql('DROP INDEX IDX_3BAE0AA761190A32 ON event');
        $this->addSql('ALTER TABLE event CHANGE club_id club_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7DF2AB4E5 FOREIGN KEY (club_id_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7DF2AB4E5 ON event (club_id_id)');
    }
}
