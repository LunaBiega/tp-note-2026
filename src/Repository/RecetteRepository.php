<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    public function getStats(int $top = 4): array
    {
        $globalStats = $this->createQueryBuilder('r')
            ->select('COUNT(r.id) AS total', 'AVG(r.time) AS avgTime')
            ->getQuery()
            ->getSingleResult();

        $topCategories = $this->createQueryBuilder('r')
            ->select('c.name AS category', 'COUNT(r.id) AS total')
            ->join('r.category', 'c')
            ->groupBy('c.id')
            ->orderBy('total', 'DESC')
            ->setMaxResults($top)
            ->getQuery()
            ->getResult();

        return [
            'total' => $globalStats['total'],
            'avgTime' => $globalStats['avgTime'],
            'topCategories' => $topCategories
        ];
    }
}
