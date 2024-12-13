<?php

namespace App\Repository;

use App\Entity\NsEcolePeriode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsEcolePeriode>
 *
 * @method NsEcolePeriode|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsEcolePeriode|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsEcolePeriode[]    findAll()
 * @method NsEcolePeriode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsEcolePeriodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsEcolePeriode::class);
    }

//    /**
//     * @return NsEcolePeriode[] Returns an array of NsEcolePeriode objects
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

//    public function findOneBySomeField($value): ?NsEcolePeriode
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
