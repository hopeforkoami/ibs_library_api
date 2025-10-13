<?php

namespace App\Repository;

use App\Entity\Ranger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ranger>
 *
 * @method Ranger|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ranger|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ranger[]    findAll()
 * @method Ranger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RangerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ranger::class);
    }

//    /**
//     * @return Ranger[] Returns an array of Ranger objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ranger
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
