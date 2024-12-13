<?php

namespace App\Repository;

use App\Entity\NsMatiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsMatiere>
 *
 * @method NsMatiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsMatiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsMatiere[]    findAll()
 * @method NsMatiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsMatiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsMatiere::class);
    }

//    /**
//     * @return NsMatiere[] Returns an array of NsMatiere objects
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

//    public function findOneBySomeField($value): ?NsMatiere
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
