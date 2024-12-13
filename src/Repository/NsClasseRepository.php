<?php

namespace App\Repository;

use App\Entity\NsClasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NsClasse>
 *
 * @method NsClasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method NsClasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method NsClasse[]    findAll()
 * @method NsClasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NsClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NsClasse::class);
    }

//    /**
//     * @return NsClasse[] Returns an array of NsClasse objects
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

//    public function findOneBySomeField($value): ?NsClasse
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
