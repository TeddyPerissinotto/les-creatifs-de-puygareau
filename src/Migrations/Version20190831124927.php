<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190831124927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP image1, DROP image2, DROP image3, DROP image4, DROP image5');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles ADD image1 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD image2 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image3 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image4 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image5 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}