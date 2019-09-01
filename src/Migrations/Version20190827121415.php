<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190827121415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A3DA5256D');
        $this->addSql('DROP INDEX IDX_E01FBE6A3DA5256D ON images');
        $this->addSql('ALTER TABLE images CHANGE image_id images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AD44F05E5 FOREIGN KEY (images_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AD44F05E5 ON images (images_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AD44F05E5');
        $this->addSql('DROP INDEX IDX_E01FBE6AD44F05E5 ON images');
        $this->addSql('ALTER TABLE images CHANGE images_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A3DA5256D FOREIGN KEY (image_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A3DA5256D ON images (image_id)');
    }
}
