<?php

namespace FitTrackerApi\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FitTrackerApi\Entity\Chart;

/**
 * @extends ServiceEntityRepository<Chart>
 *
 * @method Chart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chart[]    findAll()
 * @method Chart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chart::class);
    }

//    /**
//     * @return Chart[] Returns an array of Chart objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Chart
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
