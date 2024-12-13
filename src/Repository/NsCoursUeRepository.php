<?php

namespace App\Repository;

use App\Entity\NsCoursUe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsCoursUe>
 *
 * @method NsCoursUe|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsCoursUe|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsCoursUe[]    findAll()
 * @method NsCoursUe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsCoursUeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsCoursUe::class);
    }

//    /**
//     * @return NsCoursUe[] Returns an array of NsCoursUe objects
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

//    public function findOneBySomeField($value): ?NsCoursUe
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
