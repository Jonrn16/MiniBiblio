<?php

namespace App\Repository;

use App\Entity\Autor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AutorRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Autor::class);
    }

    public function findAutoresWithBookCount() {
        return $this->createQueryBuilder('a')
            ->select('a', 'COUNT(l.id) as numLibros')
            ->leftJoin('a.libros', 'l')
            ->groupBy('a.id')
            ->orderBy('a.fechaNacimiento', 'DESC') // Más joven = fecha de nacimiento más reciente
            ->getQuery()
            ->getResult();
    }

}