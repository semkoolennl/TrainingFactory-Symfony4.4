<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200107081146 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instructor (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, hiring_date DATE NOT NULL, salary DOUBLE PRECISION NOT NULL, INDEX IDX_31FC43DDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, training_id INT NOT NULL, instructor_id INT NOT NULL, time TIME NOT NULL, date DATE NOT NULL, location VARCHAR(255) NOT NULL, max_participants INT NOT NULL, INDEX IDX_F87474F3BEFD98D1 (training_id), INDEX IDX_F87474F38C4FC193 (instructor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, postal_code VARCHAR(7) NOT NULL, street VARCHAR(255) NOT NULL, housenumber VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, INDEX IDX_70E4FA78A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, member_id INT NOT NULL, lesson_id INT NOT NULL, payment DOUBLE PRECISION DEFAULT NULL, INDEX IDX_62A8A7A77597D3FE (member_id), INDEX IDX_62A8A7A7CDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(1000) NOT NULL, duration TIME NOT NULL, costs DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, preprovision VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, dateofbirth DATE DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user2 (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1558D4EFE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instructor ADD CONSTRAINT FK_31FC43DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F38C4FC193 FOREIGN KEY (instructor_id) REFERENCES instructor (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A77597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F38C4FC193');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7CDF80196');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A77597D3FE');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3BEFD98D1');
        $this->addSql('ALTER TABLE instructor DROP FOREIGN KEY FK_31FC43DDA76ED395');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78A76ED395');
        $this->addSql('DROP TABLE instructor');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user2');
    }
}
