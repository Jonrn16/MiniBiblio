<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
#[ORM\Table(name: 'socio')]
#[UniqueEntity(fields: ['dni'], message: 'DNI ya registrado')]
#[Assert\Expression(
    "this.isDocente() or this.isEstudiante()",
    message: "Un socio debe ser docente, estudiante o ambos."
)]
class Socio
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $dni;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private string $apellidos;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private string $nombre;

    #[ORM\Column(type: 'string')]
    private string $telefono;

    #[Assert\Expression(
        "this.isDocente() or this.isEstudiante()",
        message: "Un socio debe ser docente, estudiante o ambos"
    )]
    #[ORM\Column(type: 'boolean')]
    private bool $esDocente;
    private bool $esEstudiante;

    #[ORM\OneToMany(targetEntity: Libro::class, mappedBy: "socioPrestamo")]
    private Collection $librosPrestados;

    public function __construct()
    {
        $this->librosPrestados = new ArrayCollection();
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getLibrosPrestados(): Collection
    {
        return $this->librosPrestados;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni(string $dni): Socio
    {
        $this->dni = $dni;
        return $this;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): Socio
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Socio
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): Socio
    {
        $this->telefono = $telefono;
        return $this;
    }

    public function isEsDocente(): bool
    {
        return $this->esDocente;
    }

    public function setEsDocente(bool $esDocente): Socio
    {
        $this->esDocente = $esDocente;
        return $this;
    }

    public function isEsEstudiante(): bool
    {
        return $this->esEstudiante;
    }

    public function setEsEstudiante(bool $esEstudiante): Socio
    {
        $this->esEstudiante = $esEstudiante;
        return $this;
    }

    public function setLibrosPrestados(Collection $librosPrestados): Socio
    {
        $this->librosPrestados = $librosPrestados;
        return $this;
    }

    public function addLibroPrestado(Libro $libro): static
    {
        if (!$this->librosPrestados->contains($libro)) {
            $this->librosPrestados->add($libro);
        }
        return $this;
    }
    public function removeLibroPrestado(Libro $libro): static
    {
        $this->librosPrestados->removeElement($libro);
        return $this;
    }

}