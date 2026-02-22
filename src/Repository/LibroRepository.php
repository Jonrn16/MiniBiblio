<?php

namespace App\Repository;

use App\Entity\Libro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
class LibroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Libro::class);
    }

    public function findAllAlphabetical() {
        return $this->createQueryBuilder('l')
            ->orderBy('l.titulo', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAllByYearDesc() {
        return $this->createQueryBuilder('l')
            ->orderBy('l.anyoPublicacion', 'DESC') // Ajusta el nombre del campo si es distinto
            ->getQuery()
            ->getResult();
    }

    public function findByTituloContains($palabra) {
        return $this->createQueryBuilder('l')
            ->where('l.titulo LIKE :palabra')
            ->setParameter('palabra', '%' . $palabra . '%')
            ->getQuery()
            ->getResult();
    }

    public function findByEditorialWithoutA() {
        return $this->createQueryBuilder('l')
            ->join('l.editorial', 'e')
            ->where('e.nombre NOT LIKE :letra')
            ->setParameter('letra', '%a%')
            ->getQuery()
            ->getResult();
    }

    public function findBooksWithOneAutor() {
        return $this->createQueryBuilder('l')
            ->join('l.autores', 'a')
            ->groupBy('l.id')
            ->having('COUNT(a.id) = 1')
            ->getQuery()
            ->getResult();
    }

    public function findAllWithAutors() {
        return $this->createQueryBuilder('l')
            ->leftJoin('l.autores', 'a')
            ->addSelect('a')
            ->orderBy('l.titulo', 'ASC')
            ->getQuery()
            ->getResult();
    }

}