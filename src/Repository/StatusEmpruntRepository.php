<?php

namespace App\Repository;

use App\Entity\StatusEmprunt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusEmprunt>
 *
 * @method StatusEmprunt|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusEmprunt|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusEmprunt[]    findAll()
 * @method StatusEmprunt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusEmpruntRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusEmprunt::class);
    }

//    /**
//     * @return StatusEmprunt[] Returns an array of StatusEmprunt objects
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

//    public function findOneBySomeField($value): ?StatusEmprunt
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
