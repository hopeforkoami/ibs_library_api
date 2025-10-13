<?php

namespace App\Repository;

use App\Entity\ExemplaireLivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExemplaireLivre>
 *
 * @method ExemplaireLivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExemplaireLivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExemplaireLivre[]    findAll()
 * @method ExemplaireLivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExemplaireLivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExemplaireLivre::class);
    }

//    /**
//     * @return ExemplaireLivre[] Returns an array of ExemplaireLivre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExemplaireLivre
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
