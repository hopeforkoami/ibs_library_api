<?php

namespace App\Repository;

use App\Entity\NsEtablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsEtablissement>
 *
 * @method NsEtablissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsEtablissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsEtablissement[]    findAll()
 * @method NsEtablissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsEtablissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsEtablissement::class);
    }

//    /**
//     * @return NsEtablissement[] Returns an array of NsEtablissement objects
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

//    public function findOneBySomeField($value): ?NsEtablissement
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
