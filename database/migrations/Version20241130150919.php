<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241130150919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create social media users table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE social_media_user (
            id INT AUTO_INCREMENT NOT NULL,
            social_media VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL,
            followers INT NOT NULL,
            following INT NOT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE social_media_user');
    }
}
