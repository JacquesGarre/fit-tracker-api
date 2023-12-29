<?php

namespace FitTrackerApi\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FitTrackerApi\Entity\ExerciseType;

/**
 * @extends ServiceEntityRepository<ExerciseType>
 *
 * @method ExerciseType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciseType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciseType[]    findAll()
 * @method ExerciseType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciseType::class);
    }

//    /**
//     * @return ExerciseType[] Returns an array of ExerciseType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExerciseType
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
