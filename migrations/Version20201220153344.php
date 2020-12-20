<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220153344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, iban VARCHAR(100) NOT NULL, solde VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_CFF65260A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_transaction (compte_id INT NOT NULL, transaction_id INT NOT NULL, INDEX IDX_5E268F85F2C56620 (compte_id), INDEX IDX_5E268F852FC0CB0F (transaction_id), PRIMARY KEY(compte_id, transaction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, compte_debite_id INT DEFAULT NULL, compte_credite_id INT DEFAULT NULL, montant VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_723705D1167B0AA9 (compte_debite_id), UNIQUE INDEX UNIQ_723705D19EB8264F (compte_credite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE compte_transaction ADD CONSTRAINT FK_5E268F85F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compte_transaction ADD CONSTRAINT FK_5E268F852FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1167B0AA9 FOREIGN KEY (compte_debite_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D19EB8264F FOREIGN KEY (compte_credite_id) REFERENCES compte (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_transaction DROP FOREIGN KEY FK_5E268F85F2C56620');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1167B0AA9');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D19EB8264F');
        $this->addSql('ALTER TABLE compte_transaction DROP FOREIGN KEY FK_5E268F852FC0CB0F');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE compte_transaction');
        $this->addSql('DROP TABLE transaction');
    }
}
