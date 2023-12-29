<?php

namespace FitTrackerApi\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FitTrackerApi\Entity\MuscleGroup;

/**
 * @extends ServiceEntityRepository<MuscleGroup>
 *
 * @method MuscleGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method MuscleGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method MuscleGroup[]    findAll()
 * @method MuscleGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuscleGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MuscleGroup::class);
    }

//    /**
//     * @return MuscleGroup[] Returns an array of MuscleGroup objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MuscleGroup
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
