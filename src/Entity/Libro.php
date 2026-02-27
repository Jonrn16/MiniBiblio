<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
#[UniqueEntity(fields: ['isbn'], message: 'Este ISBN ya existe.')]
#[ORM\Table]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'El título no puede estar vacío')]
    #[Assert\Length(min: 2, minMessage: 'El título debe tener más de 1 carácter')]
    private ?string $titulo = null;
    #[ORM\Column(type: 'integer')]
    private ?int $anioPublicacion = null;
    #[ORM\Column(type: 'integer')]
    private ?int $paginas = null;

    #[ORM\Column(type: 'string')]
    #[Assert\Isbn(message: 'El ISBN no es válido')]
    private string $isbn;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\PositiveOrZero(message: 'El precio no puede ser negativo')]
    private ?int $precioCompra;
    #[ORM\ManyToOne(targetEntity: Editorial::class, inversedBy: 'libros')]
    private ?Editorial $editorial = null;
    #[ORM\ManyToMany(targetEntity: Autor::class, inversedBy: 'libros')]
    #[Assert\Count(min: 1, minMessage: 'Un libro debe tener al menos un autor')]
    private Collection $autores;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[ORM\ManyToOne(targetEntity: Socio::class, inversedBy: "librosPrestados")]
    private ?Socio $socioPrestamo;


    public function __construct()
    {
        $this->autores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitulo(): ?string
    {
        return $this->titulo;
    }
    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;
        return $this;
    }
    public function getAnioPublicacion(): ?int
    {
        return $this->anioPublicacion;
    }
    public function setAnioPublicacion(int $anioPublicacion): static
    {
        $this->anioPublicacion = $anioPublicacion;
        return $this;
    }

    public function getPaginas(): ?int
    {
        return $this->paginas;
    }
    public function setPaginas(int $paginas): static
    {
        $this->paginas = $paginas;
        return $this;
    }
    public function getEditorial(): ?Editorial
    {
        return $this->editorial;
    }
    public function setEditorial(?Editorial $editorial): static
    {
        $this->editorial = $editorial;
        return $this;
    }

    /**
     * @return Collection<int, Autor>
     */
    public function getAutores(): Collection
    {
        return $this->autores;
    }
    public function addAutor(Autor $autor): static
    {
        if (!$this->autores->contains($autor)) {
            $this->autores->add($autor);
        }
        return $this;
    }
    public function removeAutor(Autor $autor): static
    {
        $this->autores->removeElement($autor);
        return $this;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): Libro
    {
        $this->isbn = $isbn;
        return $this;
    }

    public function getPrecioCompra(): ?int
    {
        return $this->precioCompra;
    }

    public function setPrecioCompra(?int $precioCompra): Libro
    {
        $this->precioCompra = $precioCompra;
        return $this;
    }

    public function getSocioPrestamo(): ?Socio
    {
        return $this->socioPrestamo;
    }

    public function setSocioPrestamo(?Socio $socioPrestamo): Libro
    {
        $this->socioPrestamo = $socioPrestamo;
        return $this;
    }

}