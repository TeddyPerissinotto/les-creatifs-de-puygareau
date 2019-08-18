<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190818051352 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie DROP jouets_1er_age, DROP poupees, DROP puzzles, DROP vehicules, DROP figurines, DROP jeux_exterieurs, DROP chambre_enfants');
        $this->addSql('ALTER TABLE sous_categorie DROP jouets_a_tirer_pousser, DROP poussettes_landaus_lits, DROP accessoires_poupees_vetements, DROP animaux, DROP dinosaures, DROP mini_univers, DROP jardinage, DROP meubles_enfants, DROP decoration');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie ADD jouets_1er_age VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD poupees VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD puzzles VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD vehicules VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD figurines VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD jeux_exterieurs VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD chambre_enfants VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE sous_categorie ADD jouets_a_tirer_pousser VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD poussettes_landaus_lits VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD accessoires_poupees_vetements VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD animaux VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD dinosaures VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD mini_univers VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD jardinage VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD meubles_enfants VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD decoration VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
