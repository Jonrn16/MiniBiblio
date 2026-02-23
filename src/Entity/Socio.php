<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
#[ORM\Table(name: 'socio')]
class Socio
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $dni;

    #[ORM\Column(type: 'string')]
    private string $apellidos;

    #[ORM\Column(type: 'string')]
    private string $nombre;

    #[ORM\Column(type: 'string')]
    private string $telefono;

    #[ORM\Column(type: 'boolean')]
    private bool $esDocente;

    #[ORM\Column(type: 'boolean')]
    private bool $esEstudiante;

    #[ORM\OneToMany(targetEntity: Libro::class, mappedBy: "socioPrestamo")]
    private Collection $librosPrestados;

}