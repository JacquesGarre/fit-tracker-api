<?php

namespace FitTrackerApi\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FitTrackerApi\Entity\ProgramExercise;

/**
 * @extends ServiceEntityRepository<ProgramExercise>
 *
 * @method ProgramExercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramExercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramExercise[]    findAll()
 * @method ProgramExercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramExercise::class);
    }

//    /**
//     * @return ProgramExercise[] Returns an array of ProgramExercise objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProgramExercise
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
