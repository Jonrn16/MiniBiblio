<?php

namespace App\Entity;

use App\Repository\EditorialRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: EditorialRepository::class)]
#[ORM\Table(name: 'editorial')]
class Editorial
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nombre = null;
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $localidad = null;
    #[ORM\OneToMany(mappedBy: 'editorial', targetEntity: Libro::class)]
    private Collection $libros;
    public function __construct()
    {
        $this->libros = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function getLocalidad(): ?string
    {
        return $this->localidad;
    }
    public function setLocalidad(string $localidad): static
    {
        $this->localidad = $localidad;
        return $this;
    }

    /**
     * @return Collection<int, Libro>
     */
    public function getLibros(): Collection
    {
        return $this->libros;
    }
    public function addLibro(Libro $libro): static
    {
        if (!$this->libros->contains($libro)) {
            $this->libros->add($libro);
            $libro->setEditorial($this);
        }
        return $this;
    }
    public function removeLibro(Libro $libro): static
    {
        if ($this->libros->removeElement($libro)) {
// set the owning side to null (unless already changed)
            if ($libro->getEditorial() === $this) {
                $libro->setEditorial(null);
            }
        }
        return $this;
    }

}