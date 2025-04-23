<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422201753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la colonne google_authenticator_secret à symfony_demo_user';
    }

    public function up(Schema $schema): void
    {
        // la table existe déjà, on n’y ajoute que la colonne
        $this->addSql('ALTER TABLE symfony_demo_user ADD google_authenticator_secret VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // pour revenir en arrière si besoin
        $this->addSql('ALTER TABLE symfony_demo_user DROP COLUMN google_authenticator_secret');
    }
}
