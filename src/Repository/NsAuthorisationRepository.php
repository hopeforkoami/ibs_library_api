<?php

namespace App\Repository;

use App\Entity\NsAuthorisation;
use DateTime;
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
    public function checkTokenValidity(string $token): bool
    {
        // Retrieve the authorisation by token
        $authorisation = $this->findOneBy(['token' => $token]);

        if ($authorisation) {
            $dateDebut = $authorisation->getDateDebut();
            $dateFin = $authorisation->getDateFin();
            $now = new DateTime('now');
            // Check if current date is within the validity period
            if ($now->format('y-m-d') == $dateDebut->format('y-m-d') ) {
                return true;
            } else {
                // Deactivate the token by setting valid to false
                $authorisation->setValide(false);

                // Persist changes      
                $this->_em->persist($authorisation);
                $this->_em->flush();
                //echo"the current date is: ".$now->format('y-m-d')." the dateDebut is: ".$dateDebut->format('yyyy-mm-dd')." the dateFin is: ".$dateFin->format('yyyy-mm-dd');

                return false;
            }
        }

        return false;
    }
    public function checkUserRight($token,$droit):bool
    {
        
        $authorisation = $this->findOneBy(['token' => $token]);
        if ($authorisation) {
            $user = $authorisation->getUser();
            //on verifie le droit de l'utilisateur est egale au parametre droit
            if ($user->getDroit()->getId() == $droit) {
                return true;
            }
        }
        return false;
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
