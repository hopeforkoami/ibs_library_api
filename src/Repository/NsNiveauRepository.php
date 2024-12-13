<?php

namespace App\Repository;

use App\Entity\NsNiveau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsNiveau>
 *
 * @method NsNiveau|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsNiveau|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsNiveau[]    findAll()
 * @method NsNiveau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsNiveauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsNiveau::class);
    }

//    /**
//     * @return NsNiveau[] Returns an array of NsNiveau objects
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

//    public function findOneBySomeField($value): ?NsNiveau
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
