<?php

namespace App\Repository;

use App\Entity\NsDroit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsDroit>
 *
 * @method NsDroit|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsDroit|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsDroit[]    findAll()
 * @method NsDroit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsDroitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsDroit::class);
    }

//    /**
//     * @return NsDroit[] Returns an array of NsDroit objects
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

//    public function findOneBySomeField($value): ?NsDroit
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
