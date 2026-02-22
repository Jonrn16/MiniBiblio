<?php

namespace App\Repository;

use App\Entity\Editorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EditorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Editorial::class);
    }

    public function findEditorialesWithFewBooks() {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.libros', 'l')
            ->groupBy('e.id')
            ->having('COUNT(l.id) < 5')
            ->getQuery()
            ->getResult();
    }

    public function findEditorialesByBookCount() {
        return $this->createQueryBuilder('e')
            ->select('e', 'COUNT(l.id) as HIDDEN numLibros') // HIDDEN para que no afecte al objeto retornado
            ->leftJoin('e.libros', 'l')
            ->groupBy('e.id')
            ->orderBy('numLibros', 'DESC')
            ->getQuery()
            ->getResult();
    }

}