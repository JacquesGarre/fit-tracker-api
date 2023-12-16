<?php

namespace FitTrackerApi\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FitTrackerApi\Entity\ChartYAxis;

/**
 * @extends ServiceEntityRepository<ChartYAxis>
 *
 * @method ChartYAxis|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChartYAxis|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChartYAxis[]    findAll()
 * @method ChartYAxis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChartYAxisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChartYAxis::class);
    }

//    /**
//     * @return ChartYAxis[] Returns an array of ChartYAxis objects
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

//    public function findOneBySomeField($value): ?ChartYAxis
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
