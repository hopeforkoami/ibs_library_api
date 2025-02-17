<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\NsAuthorisation;
use App\Entity\Reservation;
use App\Entity\StatusEmprunt;
use App\Modele\NogSystemResponse;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt/add', name: 'app_emprunt_add', methods: ['POST'])]
    public function addReservation(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
        if ($request->getMethod() != 'POST') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $response->getSystemHttpResponse();
        }
        else{
            if (!isset($data['reservation']) || !isset($data['status']) || !isset($data['dateDebut']) || !isset($data['dateFin']) || !isset($data['dateRappel'])) {
                $response->statut = 400;
                $response->message = 'Bad request';
                return $response->getSystemHttpResponse();
            }
            else{
                //on verifie si le token dans le post est valide
                $data = json_decode($request->getContent(), true);
                $token = $data['token'];
                //$nogCustomedFunctions = new NogCustomedFunctions();
                $auth = $em->getRepository(NsAuthorisation::class);
               
                if($auth->checkTokenValidity($token)){
                    //check if the reservation already exist
                    
                    $reservation = $em->getRepository(Emprunt::class)->findBy(array(
                        'reservation' => $em->getRepository(Reservation::class)->find($data['reservation']) , 
                        'statusEmprunt' => $em->getRepository(StatusEmprunt::class)->find($data['status']),
                        'dateDebutEmprunt' => new \DateTime($data['dateDebut']) ,
                        'dateFinEmpruntPrevu' => new \DateTime($data['dateFin']) ,
                        'dateRappel' => new \DateTime($data['dateRappel']) 
                    ));
                   // var_dump($pays);
                    if($reservation){
                        $response->statut = 409;
                        $response->message = 'Emprunt already exist';
                        $response->data = $reservation[0];
                        return $response->getSystemHttpResponse();
                    }
                    else{
                        
                        //update the livre
                        //libelle,auteur_id_id, image, isbn, edition, resume,  langue_id_id, sous_categorie_id_id
                        $emprunt = new Emprunt();
                        $emprunt->setReservation($em->getRepository(Reservation::class)->find($data['reservation']));
                        $emprunt->setStatusEmpruntId($em->getRepository(StatusEmprunt::class)->find($data['status']));
                        $emprunt->setDateDebutEmprunt(new DateTime($data['dateDebut']) );
                        $emprunt->setDateFinEmpruntPrevu(new DateTime($data['dateFin']) );
                        $emprunt->setDatePrevuRappel(new DateTime($data['dateRappel']) );
                        $em->persist($emprunt);
                        $em->flush();
                        if($emprunt->getId()){
                            $response->statut = 200;
                            $response->message = 'Emprunt created';
                            $response->data = $emprunt;
                        }
                        else{
                            $response->statut = 500;
                            $response->message = 'System error';
                        }
                        
                        
                        
                    }
                    
                }
                else{
                    $response->statut = 401;
                    $response->message = 'Token expired';
                }


            }
        }

        return $response->getSystemHttpResponse();
    }

    #[Route('/emprunt/changestatus', name: 'app_emprunt_status_update', methods: ['UPDATE'])]
    public function changeStatusReservation(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
        if ($request->getMethod() != 'UPDATE') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $response->getSystemHttpResponse();
        }
        else{
            if (!isset($data['id']) || !isset($data['status']) ) {
                $response->statut = 400;
                $response->message = 'Bad request';
                return $response->getSystemHttpResponse();
            }
            else{
                //on verifie si le token dans le post est valide
                $data = json_decode($request->getContent(), true);
                $token = $data['token'];
                //$nogCustomedFunctions = new NogCustomedFunctions();
                $auth = $em->getRepository(NsAuthorisation::class);
               
                if($auth->checkTokenValidity($token)){
                    //check if the reservation already exist
                    
                    $emprunt = $em->getRepository(Emprunt::class)->find($data['id']?? 1);
                   // var_dump($pays);
                    if(!$emprunt){
                        $response->statut = 409;
                        $response->message = 'emprunt not found';
                        $response->data = [];
                        return $response->getSystemHttpResponse();
                    }
                    else{
                        
                        //update the status of the reservation
                        $emprunt = new Emprunt();
                        $emprunt->setStatusEmpruntId($em->getRepository(StatusEmprunt::class)->find($data['status'?? 1]));
                        $em->persist($emprunt->getStatusEmpruntId());
                        $em->persist($emprunt);
                        $em->flush();
                        if($emprunt->getId()){
                            $response->statut = 200;
                            $response->message = 'Emprunt Status changed';
                            $response->data = $emprunt;
                        }
                        else{
                            $response->statut = 500;
                            $response->message = 'System error';
                        }
                        
                        
                        
                    }
                    
                }
                else{
                    $response->statut = 401;
                    $response->message = 'Token expired';
                }


            }
        }

        return $response->getSystemHttpResponse();
    }
}
