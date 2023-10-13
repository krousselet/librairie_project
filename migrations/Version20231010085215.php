<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010085215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT DEFAULT NULL, note DOUBLE PRECISION DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8F91ABF0C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT DEFAULT NULL, nom_categorie VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3AF346686702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt (id INT AUTO_INCREMENT NOT NULL, id_exemplaire_id INT DEFAULT NULL, date_emprunt DATE NOT NULL, date_retour DATE NOT NULL, UNIQUE INDEX UNIQ_364071D7E66B7B44 (id_exemplaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exemplaires (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT DEFAULT NULL, id_livre_id INT DEFAULT NULL, etat LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', statut LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_551C55FC6EE5C49 (id_utilisateur_id), UNIQUE INDEX UNIQ_551C55F6702C95E (id_livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livres (id INT AUTO_INCREMENT NOT NULL, id_exemplaire_id INT DEFAULT NULL, avis_id INT DEFAULT NULL, titre VARCHAR(100) NOT NULL, auteur VARCHAR(255) NOT NULL, editeur LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', isbn VARCHAR(13) NOT NULL, quantite INT NOT NULL, UNIQUE INDEX UNIQ_927187A4E66B7B44 (id_exemplaire_id), INDEX IDX_927187A4197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notifications (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_6000B0D3C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendus (id INT AUTO_INCREMENT NOT NULL, id_emprunt_id INT DEFAULT NULL, date_rendu DATE NOT NULL, UNIQUE INDEX UNIQ_A999BBADBF56F43 (id_emprunt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346686702C95E FOREIGN KEY (id_livre_id) REFERENCES livres (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7E66B7B44 FOREIGN KEY (id_exemplaire_id) REFERENCES exemplaires (id)');
        $this->addSql('ALTER TABLE exemplaires ADD CONSTRAINT FK_551C55FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE exemplaires ADD CONSTRAINT FK_551C55F6702C95E FOREIGN KEY (id_livre_id) REFERENCES livres (id)');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4E66B7B44 FOREIGN KEY (id_exemplaire_id) REFERENCES exemplaires (id)');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE notifications ADD CONSTRAINT FK_6000B0D3C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rendus ADD CONSTRAINT FK_A999BBADBF56F43 FOREIGN KEY (id_emprunt_id) REFERENCES emprunt (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0C6EE5C49');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF346686702C95E');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7E66B7B44');
        $this->addSql('ALTER TABLE exemplaires DROP FOREIGN KEY FK_551C55FC6EE5C49');
        $this->addSql('ALTER TABLE exemplaires DROP FOREIGN KEY FK_551C55F6702C95E');
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4E66B7B44');
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4197E709F');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY FK_6000B0D3C6EE5C49');
        $this->addSql('ALTER TABLE rendus DROP FOREIGN KEY FK_A999BBADBF56F43');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE emprunt');
        $this->addSql('DROP TABLE exemplaires');
        $this->addSql('DROP TABLE livres');
        $this->addSql('DROP TABLE notifications');
        $this->addSql('DROP TABLE rendus');
    }
}
