<?php

namespace App\Repository;

use App\Entity\NsAuthorisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsAuthorisation>
 *
 * @method NsAuthorisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsAuthorisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsAuthorisation[]    findAll()
 * @method NsAuthorisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsAuthorisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsAuthorisation::class);
    }

//    /**
//     * @return NsAuthorisation[] Returns an array of NsAuthorisation objects
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

//    public function findOneBySomeField($value): ?NsAuthorisation
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
