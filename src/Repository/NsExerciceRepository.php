<?php

namespace App\Repository;

use App\Entity\NsExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsExercice>
 *
 * @method NsExercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsExercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsExercice[]    findAll()
 * @method NsExercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsExercice::class);
    }

//    /**
//     * @return NsExercice[] Returns an array of NsExercice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NsExercice
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
