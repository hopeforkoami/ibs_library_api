<?php

namespace App\Repository;

use App\Entity\StatusReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusReservation>
 *
 * @method StatusReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusReservation[]    findAll()
 * @method StatusReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusReservation::class);
    }

//    /**
//     * @return StatusReservation[] Returns an array of StatusReservation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatusReservation
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
