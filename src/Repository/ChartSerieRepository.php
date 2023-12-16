<?php

namespace FitTrackerApi\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FitTrackerApi\Entity\ChartSerie;

/**
 * @extends ServiceEntityRepository<ChartSerie>
 *
 * @method ChartSerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChartSerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChartSerie[]    findAll()
 * @method ChartSerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChartSerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChartSerie::class);
    }

//    /**
//     * @return ChartSerie[] Returns an array of ChartSerie objects
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

//    public function findOneBySomeField($value): ?ChartSerie
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
