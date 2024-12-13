<?php

namespace App\Repository;

use App\Entity\NsChapitre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsChapitre>
 *
 * @method NsChapitre|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsChapitre|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsChapitre[]    findAll()
 * @method NsChapitre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsChapitreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsChapitre::class);
    }

//    /**
//     * @return NsChapitre[] Returns an array of NsChapitre objects
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

//    public function findOneBySomeField($value): ?NsChapitre
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
