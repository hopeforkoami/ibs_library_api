<?php

namespace App\Repository;

use App\Entity\NsEpreuve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsEpreuve>
 *
 * @method NsEpreuve|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsEpreuve|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsEpreuve[]    findAll()
 * @method NsEpreuve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsEpreuveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsEpreuve::class);
    }

//    /**
//     * @return NsEpreuve[] Returns an array of NsEpreuve objects
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

//    public function findOneBySomeField($value): ?NsEpreuve
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
