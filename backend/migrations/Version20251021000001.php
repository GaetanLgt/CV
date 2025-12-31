<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251021000001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial tables for Portfolio 3D';
    }

    public function up(Schema $schema): void
    {
        // Project table
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE project (
            id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            url VARCHAR(500) DEFAULT NULL,
            tags JSON NOT NULL,
            featured BOOLEAN NOT NULL,
            cover VARCHAR(500) DEFAULT NULL,
            position INT DEFAULT NULL,
            PRIMARY KEY(id)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE989D9B62 ON project (slug)');

        // Experience table
        $this->addSql('CREATE SEQUENCE experience_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE experience (
            id INT NOT NULL,
            company VARCHAR(255) NOT NULL,
            position VARCHAR(255) NOT NULL,
            start_date DATE NOT NULL,
            end_date DATE DEFAULT NULL,
            description TEXT NOT NULL,
            technologies JSON NOT NULL,
            logo VARCHAR(500) DEFAULT NULL,
            current BOOLEAN NOT NULL,
            PRIMARY KEY(id)
        )');

        // Testimonial table
        $this->addSql('CREATE SEQUENCE testimonial_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE testimonial (
            id INT NOT NULL,
            name VARCHAR(255) NOT NULL,
            position VARCHAR(255) NOT NULL,
            company VARCHAR(255) DEFAULT NULL,
            content TEXT NOT NULL,
            avatar VARCHAR(500) DEFAULT NULL,
            rating INT DEFAULT NULL,
            PRIMARY KEY(id)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP SEQUENCE experience_id_seq CASCADE');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP SEQUENCE testimonial_id_seq CASCADE');
        $this->addSql('DROP TABLE testimonial');
    }
}
