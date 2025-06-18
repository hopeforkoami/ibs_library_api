<?php

namespace App\Controller;

use App\Entity\Exemplaire;
use App\Entity\ExemplaireLivre;
use App\Entity\Membre;
use App\Entity\NsAuthorisation;
use App\Entity\Reservation;
use App\Entity\StatusReservation;
use App\Modele\NogSystemResponse;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ReservationController extends AbstractController
{
    #[Route('/reservation/add', name: 'app_reservation_add', methods: ['POST', 'OPTIONS'])]
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
            $data = json_decode($request->getContent(), true);
            
            if (!isset($data['idMembre']) || !isset($data['contenuPanier']) || !isset($data['dateDebut']) || !isset($data['dateFin']) ||  !isset($data['statut']) ) {
                $response->statut = 400;
                $response->message = 'Bad request';
                return $response->getSystemHttpResponse();
            }
            else{
                //on verifie si le token dans le post est valide
                $data = json_decode($request->getContent(), true);
                $token = $request->query->get('token', '');
                //$nogCustomedFunctions = new NogCustomedFunctions();
                $auth = $em->getRepository(NsAuthorisation::class);
               
                if($auth->checkTokenValidity($token)){
                    //check if the reservation already exist
                    
                    $reservation = $em->getRepository(Reservation::class)->findBy(array(
                        'membre' => $em->getRepository(Membre::class)->find($data['idMembre']) , 
                        'statusReservation' => $em->getRepository(Membre::class)->find($data['statut']),
                        'dateDebutPrevu' => new \DateTime($data['dateDebut']) ,
                        'dateFinPrevu' => new \DateTime($data['dateFin']) 
                    ));
                   // var_dump($pays);
                    if($reservation){
                        $response->statut = 409;
                        $response->message = 'la Reservation already have a resrvation';
                        $response->data = $reservation[0];
                        return $response->getSystemHttpResponse();
                    }
                    else{
                        
                        //update the livre
                        //libelle,auteur_id_id, image, isbn, edition, resume,  langue_id_id, sous_categorie_id_id
                        $reservation = new Reservation();
                        $reservation->setMembre($em->getRepository(Membre::class)->find($data['idMembre']));
                        $reservation->setStatusReservation($em->getRepository(StatusReservation::class)->find($data['statut']));
                        $reservation->setDateDebutPrevu(new DateTime($data['dateDebut']) );
                        $reservation->setDateFinPrevu(new DateTime($data['dateFin']) );
                        $reservation->setDateReservation(new DateTime('now') );
                        //ajouter le contenu du pannier
                        $contenuPanier = $data['contenuPanier'];
                        foreach($contenuPanier as $contenu){
                            $exemplaire = $em->getRepository(ExemplaireLivre::class)->find($contenu['id']);
                            if(!$exemplaire){
                                $response->statut = 409;
                                $response->message = 'exemplaire not found';
                                $response->data = [];
                                return $response->getSystemHttpResponse();
                            }
                            //on verifie si l'exemplaire est libre
                            if($exemplaire->isLibre() != 1){
                                $response->statut = 409;
                                $response->message = 'exemplaire not available';
                                $response->data = [];
                                return $response->getSystemHttpResponse();
                            }
                            //on ajoute l'exemplaire à la reservation
                            $reservation->addExemplaireId($exemplaire);
                            $em->persist($exemplaire);
                            $reservation->addExemplaireId($exemplaire);
                            
                        }
                        $em->persist($reservation);
                        $em->flush();
                        $response->statut = 200;
                        $response->message = 'reservation effectue avec success';
                        $response->data = [];

                        
                        
                        
                        
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

    #[Route('/reservation/changestatus', name: 'app_reservation_status_update', methods: ['UPDATE'])]
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
                    
                    $reservation = $em->getRepository(Reservation::class)->find($data['id']?? 1);
                   // var_dump($pays);
                    if(!$reservation){
                        $response->statut = 409;
                        $response->message = 'reservation not found';
                        $response->data = [];
                        return $response->getSystemHttpResponse();
                    }
                    else{
                        
                        //update the status of the reservation
                        $reservation = new Reservation();
                        $reservation->setStatusReservation($em->getRepository(StatusReservation::class)->find($data['status'?? 1]));
                        $em->persist($reservation->getStatusReservation());
                        $em->persist($reservation);
                        $em->flush();
                        if($reservation->getId()){
                            $response->statut = 200;
                            $response->message = 'reservation Status changed';
                            $response->data = $reservation;
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

    #[Route('/reservation/getStatus', name: 'app_reservation_status_update', methods: ['GET', 'OPTIONS'])]
    public function listReservationStatus(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
        if ($request->getMethod() != 'GET') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $response->getSystemHttpResponse();
        }
        else{
            //on verifie si le token dans le post est valide
            $data = json_decode($request->getContent(), true);
            $token = $request->query->get('token', '');
            //$nogCustomedFunctions = new NogCustomedFunctions();
            $auth = $em->getRepository(NsAuthorisation::class);
           
            if($auth->checkTokenValidity($token)){
                //check if the reservation already exist
                
                $status = $em->getRepository(StatusReservation::class)->findAll();
               // var_dump($pays);
                if(!$status){
                    $response->statut = 205;
                    $response->message = 'reservation not found';
                    $response->data = [];
                    return $response->getSystemHttpResponse();
                }
                else{
                    
                    $response->statut = 200;
                    $response->message = "Reservation status founded";
                    $response->data = json_decode($serializer->serialize($status, 'json',['groups' => 'reservation_status:read'])); 
                }
                
            }
            else{
                $response->statut = 401;
                $response->message = 'Token expired';
            }
        }

        return $response->getSystemHttpResponse();
    }

    #[Route('/reservation/listfull', name: 'app_reservation_list_full', methods: ['GET'])]
    public function listAll(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        
        // Check if the request method is GET
        if ($request->getMethod() != 'GET') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $this->json($response->getSystemResponse());
        }

        // Retrieve the token from GET parameters
        $token = $request->query->get('token', '');
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            // Check if the user has the correct rights
            // Fetch all programmes
            $reservations= $em->getRepository(Reservation::class)->findAll();

            if (!$reservations) {
                $response->statut = 404;
                $response->message = 'reservations not found';
                return $this->json($response->getSystemHttpResponse());
            }
            else{
                
                $response->statut = 200;
                $response->message = 'reservations list';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($reservations, 'json',['groups' => 'reservation:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }
    #[Route('/reservation/details', name: 'app_reservation_details', methods: ['GET'])]
    public function detailsReservation(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        
        // Check if the request method is GET
        if ($request->getMethod() != 'GET') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $this->json($response->getSystemResponse());
        }

        // Retrieve the token from GET parameters
        $token = $request->query->get('token', '');
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            // Check if the user has the correct rights
            // Fetch all programmes
            $reservationId = $request->query->get('id', '');
            $reservation= $em->getRepository(Reservation::class)->find($reservationId);

            if (!$reservation) {
                $response->statut = 404;
                $response->message = 'reservation not found';
                return $this->json($response->getSystemHttpResponse());
            }
            else{
                
                $response->statut = 200;
                $response->message = 'reservations details';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($reservation, 'json',['groups' => 'reservation:details'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }


}
