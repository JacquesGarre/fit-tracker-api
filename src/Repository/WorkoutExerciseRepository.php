<?php

namespace FitTrackerApi\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FitTrackerApi\Entity\WorkoutExercise;

/**
 * @extends ServiceEntityRepository<WorkoutExercise>
 *
 * @method WorkoutExercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkoutExercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkoutExercise[]    findAll()
 * @method WorkoutExercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkoutExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkoutExercise::class);
    }

//    /**
//     * @return WorkoutExercise[] Returns an array of WorkoutExercise objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WorkoutExercise
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
