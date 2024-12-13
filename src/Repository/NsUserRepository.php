<?php

namespace App\Repository;

use App\Entity\NsUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsUser>
 *
 * @method NsUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsUser[]    findAll()
 * @method NsUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsUser::class);
    }

//    /**
//     * @return NsUser[] Returns an array of NsUser objects
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

//    public function findOneBySomeField($value): ?NsUser
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
