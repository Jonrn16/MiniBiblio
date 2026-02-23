<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260223082044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autor (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, fecha_nacimiento DATE NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE editorial (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, localidad VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE libro (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, anio_publicacion INT NOT NULL, paginas INT NOT NULL, isbn VARCHAR(255) NOT NULL, precio_compra INT DEFAULT NULL, socio_prestamo INT DEFAULT NULL, editorial_id INT DEFAULT NULL, INDEX IDX_5799AD2BBAF1A24D (editorial_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE libro_autor (libro_id INT NOT NULL, autor_id INT NOT NULL, INDEX IDX_F7588AEFC0238522 (libro_id), INDEX IDX_F7588AEF14D45BBE (autor_id), PRIMARY KEY (libro_id, autor_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE socio (id INT AUTO_INCREMENT NOT NULL, dni VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, telefono VARCHAR(255) NOT NULL, es_docente TINYINT NOT NULL, es_estudiante TINYINT NOT NULL, UNIQUE INDEX UNIQ_38B653097F8F253B (dni), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT FK_5799AD2BBAF1A24D FOREIGN KEY (editorial_id) REFERENCES editorial (id)');
        $this->addSql('ALTER TABLE libro_autor ADD CONSTRAINT FK_F7588AEFC0238522 FOREIGN KEY (libro_id) REFERENCES libro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE libro_autor ADD CONSTRAINT FK_F7588AEF14D45BBE FOREIGN KEY (autor_id) REFERENCES autor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE libro DROP FOREIGN KEY FK_5799AD2BBAF1A24D');
        $this->addSql('ALTER TABLE libro_autor DROP FOREIGN KEY FK_F7588AEFC0238522');
        $this->addSql('ALTER TABLE libro_autor DROP FOREIGN KEY FK_F7588AEF14D45BBE');
        $this->addSql('DROP TABLE autor');
        $this->addSql('DROP TABLE editorial');
        $this->addSql('DROP TABLE libro');
        $this->addSql('DROP TABLE libro_autor');
        $this->addSql('DROP TABLE socio');
    }
}
