<?php

namespace App\Repository;

use App\Entity\NsPays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsPays>
 *
 * @method NsPays|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsPays|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsPays[]    findAll()
 * @method NsPays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsPaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsPays::class);
    }

//    /**
//     * @return NsPays[] Returns an array of NsPays objects
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

//    public function findOneBySomeField($value): ?NsPays
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
