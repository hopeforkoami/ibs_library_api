<?php

namespace App\Repository;

use App\Entity\Colonne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Colonne>
 *
 * @method Colonne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Colonne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Colonne[]    findAll()
 * @method Colonne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Colonne::class);
    }

//    /**
//     * @return Colonne[] Returns an array of Colonne objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Colonne
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
