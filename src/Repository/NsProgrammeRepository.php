<?php

namespace App\Repository;

use App\Entity\NsProgramme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsProgramme>
 *
 * @method NsProgramme|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsProgramme|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsProgramme[]    findAll()
 * @method NsProgramme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsProgrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsProgramme::class);
    }

//    /**
//     * @return NsProgramme[] Returns an array of NsProgramme objects
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

//    public function findOneBySomeField($value): ?NsProgramme
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
