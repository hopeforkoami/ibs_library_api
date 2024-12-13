<?php

namespace App\Repository;

use App\Entity\NsSerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsSerie>
 *
 * @method NsSerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsSerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsSerie[]    findAll()
 * @method NsSerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsSerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsSerie::class);
    }

//    /**
//     * @return NsSerie[] Returns an array of NsSerie objects
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

//    public function findOneBySomeField($value): ?NsSerie
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
