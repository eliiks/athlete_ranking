<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220801084148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B8321B8EE3872 FOREIGN KEY (club) REFERENCES club (id)');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B832164C19C1 FOREIGN KEY (category) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_C03B8321B8EE3872 ON athlete (club)');
        $this->addSql('CREATE INDEX IDX_C03B832164C19C1 ON athlete (category)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA761190A32');
        $this->addSql('DROP INDEX IDX_3BAE0AA761190A32 ON event');
        $this->addSql('ALTER TABLE event CHANGE club_id club INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7B8EE3872 FOREIGN KEY (club) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7B8EE3872 ON event (club)');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F71F7E88B');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FFE6BCB8B');
        $this->addSql('DROP INDEX IDX_AB55E24FFE6BCB8B ON participation');
        $this->addSql('DROP INDEX IDX_AB55E24F71F7E88B ON participation');
        $this->addSql('DROP INDEX participation_idx ON participation');
        $this->addSql('ALTER TABLE participation ADD event INT NOT NULL, ADD athlete INT NOT NULL, DROP event_id, DROP athlete_id');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F3BAE0AA7 FOREIGN KEY (event) REFERENCES event (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FC03B8321 FOREIGN KEY (athlete) REFERENCES athlete (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F3BAE0AA7 ON participation (event)');
        $this->addSql('CREATE INDEX IDX_AB55E24FC03B8321 ON participation (athlete)');
        $this->addSql('CREATE UNIQUE INDEX participation_idx ON participation (event, athlete)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B8321B8EE3872');
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B832164C19C1');
        $this->addSql('DROP INDEX IDX_C03B8321B8EE3872 ON athlete');
        $this->addSql('DROP INDEX IDX_C03B832164C19C1 ON athlete');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7B8EE3872');
        $this->addSql('DROP INDEX IDX_3BAE0AA7B8EE3872 ON event');
        $this->addSql('ALTER TABLE event CHANGE club club_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA761190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA761190A32 ON event (club_id)');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F3BAE0AA7');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FC03B8321');
        $this->addSql('DROP INDEX IDX_AB55E24F3BAE0AA7 ON participation');
        $this->addSql('DROP INDEX IDX_AB55E24FC03B8321 ON participation');
        $this->addSql('DROP INDEX participation_idx ON participation');
        $this->addSql('ALTER TABLE participation ADD event_id INT NOT NULL, ADD athlete_id INT NOT NULL, DROP event, DROP athlete');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FFE6BCB8B FOREIGN KEY (athlete_id) REFERENCES athlete (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24FFE6BCB8B ON participation (athlete_id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F71F7E88B ON participation (event_id)');
        $this->addSql('CREATE UNIQUE INDEX participation_idx ON participation (event_id, athlete_id)');
    }
}
