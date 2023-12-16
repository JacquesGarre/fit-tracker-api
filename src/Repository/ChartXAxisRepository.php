<?php

namespace FitTrackerApi\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FitTrackerApi\Entity\ChartXAxis;

/**
 * @extends ServiceEntityRepository<ChartXAxis>
 *
 * @method ChartXAxis|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChartXAxis|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChartXAxis[]    findAll()
 * @method ChartXAxis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChartXAxisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChartXAxis::class);
    }

//    /**
//     * @return ChartXAxis[] Returns an array of ChartXAxis objects
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

//    public function findOneBySomeField($value): ?ChartXAxis
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
